@extends("layouts.app")

@section('content')

<div>
    <form method="POST" action="">
        @csrf

        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="middle_names">Middle Names</label>
        <input type="text" id="middle_names" name="middle_names">

        <label for="surname">Surname</label>
        <input type="text" id="surname" name="surname" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <button type="submit">Sign up</button>

    </form>
    <p>Already have an account? <a href="#">Login here</a></p>
</div>

@endsection
