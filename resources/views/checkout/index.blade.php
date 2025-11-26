@extends('layouts.app')

@section('content')
<h1>Checkout</h1>

<table class="table">
    <thead>
    <tr>
        <th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cart as $item)
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>${{ number_format($item['price'],2) }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>${{ number_format($item['price'] * $item['quantity'],2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<h4>Total: ${{ number_format($total, 2) }}</h4>

<form action="{{ route('checkout.process') }}" method="POST" class="mt-3">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email for receipt</label>
        <input type="email" id="email" name="email" class="form-control" required>
        @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <button class="btn btn-primary">Pay with Stripe</button>
</form>

{{-- Placeholder for PayPal later --}}
{{-- <button class="btn btn-outline-secondary mt-2">Pay with PayPal (coming soon)</button> --}}
@endsection
