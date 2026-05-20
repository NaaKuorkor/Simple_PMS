@extends('layouts.app')

@section("content")

<div>
    <form>
        @csrf
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password" >Password</label>
        <input type="password" id="password" name="email" required>

        <button type="submit">Login</button>
    </form>

    <p>Click <a href="#">here</a> to sign up</p>
</div>

@endsection
