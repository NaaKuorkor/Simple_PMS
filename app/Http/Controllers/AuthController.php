<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                "first_name" => "string|required|max:100",
                "middle_names" => "string|nullable",
                "surname" => "string|required|max:100",
                "username" => "string|required|unique:tblusers,username",
                "phone" => "string|required|max:12",
                "email" => "email|required|unique:tblusers,email",
                "password" => "string|required|min:8|confirmed"
            ]);

            do {
                $user_id = "USR" . rand(1000, 9999);
            } while (User::where("user_id", $user_id)->exists());

            $user = User::create([
                "user_id" => $user_id,
                "first_name" => $data["first_name"],
                "middle_names" => $data["middle_names"],
                "surname" => $data["surname"],
                "username" => $data["username"],
                "email" => $data["email"],
                "password" => Hash::make($data["password"]),
                "phone" => $data["phone"]

            ]);

            $url = URL::temporarySignedRoute(
                'verify.email',
                now()->addMinutes(10),
                ["id" => $user->id]
            );

            Mail::to($user->email)->send(new EmailVerificationMail($user, $url));

            return redirect()->route('login')->with('success', 'Verification email sent. Please check your inbox.');
        } catch (\Exception $e) {
            Log::error('Registration failed', [
                "message" => $e->getMessage(),
                "trace" => $e->getTraceAsString()
            ]);

            return back()->with("error", "An error occured in creating your account");
        }
    }

    public function verifyEmail($id)
    {
        $user = User::findOrFail($id);

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect()->route('login')->with('success', 'Email verified successfully. Proceed to login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => "email|required",
            "password" => "string|required|min:8"
        ]);

        try {
            $user = User::where('email', $data['email'])->first();

            if (!$user || !Hash::check($data['password'], $user->password)) {
                return back()->withErrors([
                    'email' =>  'Credentials do not match our records'
                ])->onlyInput();
            }

            if (!$user->email_verified_at) {
                return back()->withErrors([
                    'email' => "Verify your email first"
                ])->onlyInput();
            }

            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->route('/')->with('success', 'Login Successful');
        } catch (\Exception $e) {
            Log::error('Login failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Login failed')->only('email');
        }
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Successfully logged out');
    }
}
