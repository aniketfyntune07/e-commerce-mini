@extends('layouts.app')

@section('content')
<h1>Cart</h1>

@if(empty($cart))
    <p>Your cart is empty.</p>
@else
    <table class="table">
        <thead>
        <tr>
            <th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th><th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($cart as $id => $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>${{ number_format($item['price'],2) }}</td>
                <td>
                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm me-2" style="width:80px;">
                        <button class="btn btn-sm btn-outline-primary">Update</button>
                    </form>
                </td>
                <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                <td>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h4>Total: ${{ number_format($total, 2) }}</h4>

    <div class="d-flex gap-2 mt-3">
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button class="btn btn-outline-danger">Clear Cart</button>
        </form>
        <a href="{{ route('checkout.index') }}" class="btn btn-success ms-auto">Proceed to Checkout</a>
    </div>
@endif
@endsection
