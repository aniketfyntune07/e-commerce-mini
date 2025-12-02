@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">

        <h3 class="text-center mb-4">Admin Login</h3>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            
            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Admin Email</label>
                <input 
                    name="email" 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Enter email"
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

            <!-- Submit -->
            <button type="submit" class="btn btn-dark w-100 mb-2">
                Login as Admin
            </button>

            <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary w-100">
                Back to Shop
            </a>
        </form>
    </div>
</div>
@endsection
