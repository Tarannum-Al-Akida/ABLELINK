@extends('layouts.auth')

@section('title', 'Admin login · Ablelink')

@section('content')
    <h1>Admin portal</h1>
    <p>Only Ablelink administrators can access this area.</p>

    <form method="POST" action="{{ route('admin.login.submit') }}" aria-label="Admin login form">
        @csrf
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>

        <label for="password">Password</label>
        <input id="password" name="password" type="password" required>

        <label style="display:flex;align-items:center;gap:.5rem">
            <input type="checkbox" name="remember" value="1" @checked(old('remember'))> Keep me signed in
        </label>

        <button type="submit">Enter admin dashboard</button>
    </form>
@endsection
