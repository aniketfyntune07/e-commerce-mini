@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow p-4" style="width: 350px; border-radius: 12px;">
        
        <h3 class="text-center mb-4 fw-bold">Login</h3>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input 
                    name="email" 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Enter your email"
                    required
                >
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input 
                    name="password" 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Enter your password"
                    required
                >
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Login Button --}}
            <button type="submit" class="btn btn-dark w-100 py-2 fw-semibold">
                Login
            </button>

            {{-- Optional text --}}
            <div class="text-center mt-3">
                <small>
                    Don't have an account?  
                    <a href="{{ route('register') }}">Register</a>
                </small>
            </div>
        </form>

    </div>
</div>
@endsection
