@extends('layouts.app')

@section('content')

<div class="card">

    <h1>Create Account</h1>

    <form action="{{ route('register') }}" method="POST">

        @csrf

        <label>Name</label>

        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            required
        >

        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror


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

        @error('password')
            <p class="error">{{ $message }}</p>
        @enderror


        <label>Confirm Password</label>

        <input
            type="password"
            name="password_confirmation"
            required
        >

        <button type="submit">
            Register
        </button>

    </form>

    <p>
        Already have an account?

        <a href="{{ route('login') }}">
            Login
        </a>
    </p>

</div>

@endsection