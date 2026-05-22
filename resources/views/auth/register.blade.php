@extends("layouts.app")

@section('content')

<div>
    <h2>Registration</h2>
    @if(session('error'))
        <div>
        {{ session('error')}}
        </div>
    @endif
    <form method="POST" action="{{ route('user.register')}}">
        @csrf

        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="middle_names">Middle Names</label>
        <input type="text" id="middle_names" name="middle_names">

        <label for="surname">Surname</label>
        <input type="text" id="surname" name="surname" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" placeholder="+233xxxxxxxxx" maxlength="13" required>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm">Confirm Password</label>
        <input type="password" id="confirm" name="password_confirmation" required>

        <button type="submit">Sign up</button>

    </form>
    <p>Already have an account? <a href="/login">Login here</a></p>
</div>

@endsection
