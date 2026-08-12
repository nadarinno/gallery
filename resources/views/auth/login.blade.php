@extends('layouts.app')

@section('content')

<div class="card">

    <h1>Login</h1>

    <form action="{{ route('login') }}" method="POST">

        @csrf

        <label>Email</label>

        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
        >

        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror


        <label>Password</label>

        <input
            type="password"
            name="password"
            required
        >

        <button type="submit">
            Login
        </button>

    </form>

    <p>
        Don't have an account?

        <a href="{{ route('register') }}">
            Register
        </a>
    </p>

</div>

@endsection