@extends('layouts.app')

@section("content")

<div>
    <h2>Login</h2>
    @if (session('success'))
        <div>
        {{session('success')}}
        </div>
    @endif
    @if(session('error'))
        <div>{{ session('error') }}</div>
    @endif
    <form action="/" method="POST">
        @csrf

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password" >Password</label>
        <input type="password" id="password" name="email" required>

        <button type="submit">Login</button>
    </form>

    <p>Click <a href="/register">here</a> to sign up</p>
</div>

@endsection
