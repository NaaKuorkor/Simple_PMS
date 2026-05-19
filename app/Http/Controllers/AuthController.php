<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
                "username" => "string|required|unique",
                "phone" => "string|required|max:12",
                "email" => "email|required",
                "password" => "string|required|min:8"
            ]);

            do {
                $user_id = "USR" . rand(1000, 9999);
            } while (User::where("user_id", $user_id)->exists());

            $user = User::create([
                "user_id" => $user_id,
                "first_name" => $data["first_name"],
                "middle_name" => $data["middle_name"],
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

            return response()->json([
                "status" => "success",
                "message" => "Registration successful! Check your mail inbox for an email verification link to proceed."
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                "error" => $e->getMessage(),
                "message" => "An error occured in creating your account"
            ]);
        }
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => "string|required",
            "password" => "string|required|min:8"
        ]);
    }

    public function logout() {}
}
