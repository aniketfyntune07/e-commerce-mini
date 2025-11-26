@extends('layouts.app')

@section('content')
<h1 class="mb-4">Products</h1>

<div class="row">
    @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">${{ number_format($product->price, 2) }}</p>
                    <a href="{{ route('shop.show', $product) }}" class="btn btn-sm btn-outline-primary mt-auto">View</a>
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-2">
                        @csrf
                        <button class="btn btn-sm btn-primary w-100">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{ $products->links() }}
@endsection
