@extends('layouts.app')

@section('content')
<h1 class="mb-4">Product</h1>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            @endif

            <div class="card-body d-flex flex-column">
                <h3 class="card-title">{{ $product->name }}</h3>
                <p class="card-text">{{ $product->description }}</p>
                <p class="h5">${{ number_format($product->price, 2) }}</p>
                <p>Stock: {{ $product->stock }}</p>

                <div class="mt-auto">
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button class="btn btn-primary">Add to cart</button>
                    </form>

                    <a href="{{ route('shop.index') }}" class="btn btn-link">Back to shop</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
