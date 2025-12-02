@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm p-4" style="max-width: 450px; width: 100%;">
        <h3 class="text-center mb-4">Create an Account</h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input 
                    name="name" 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Enter your name"
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input 
                    name="email" 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="you@example.com"
                    required
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input 
                    name="password" 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    placeholder="Enter password"
                    required
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input 
                    name="password_confirmation" 
                    type="password" 
                    class="form-control"
                    placeholder="Re-enter password"
                    required
                >
            </div>

            <!-- Register button -->
            <button type="submit" class="btn btn-primary w-100 mb-2">
                Register
            </button>

            <!-- Already have an account -->
            <div class="text-center">
                <a href="{{ route('login') }}" class="text-decoration-none">
                    Already have an account? Login
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
