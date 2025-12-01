@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h2 class="mb-4">Admin Dashboard</h2>

    <div class="row g-3">

        <!-- Manage Products -->
        <div class="col-md-4">
            <a href="{{ route('admin.products.index') }}" class="text-decoration-none">
                <div class="card shadow-sm p-4 h-100">
                    <h4 class="mb-2">Products</h4>
                    <p class="text-muted">View, edit, and manage all products.</p>
                </div>
            </a>
        </div>

        <!-- Create Product -->
        <div class="col-md-4">
            <a href="{{ route('admin.products.create') }}" class="text-decoration-none">
                <div class="card shadow-sm p-4 h-100">
                    <h4 class="mb-2">Add Product</h4>
                    <p class="text-muted">Create new products for your store.</p>
                </div>
            </a>
        </div>

        <!-- Orders (Optional) -->
        <div class="col-md-4">
            <a href="#" class="text-decoration-none">
                <div class="card shadow-sm p-4 h-100">
                    <h4 class="mb-2">Orders</h4>
                    <p class="text-muted">Manage customer orders (coming soon).</p>
                </div>
            </a>
        </div>

    </div>

</div>
@endsection
