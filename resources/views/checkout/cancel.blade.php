@extends('layouts.app')

@section('content')
<h1>Payment Cancelled ❌</h1>
@if($order)
    <p>Your order #{{ $order->id }} was not completed.</p>
@endif
<a href="{{ route('cart.index') }}" class="btn btn-primary mt-3">Back to Cart</a>
@endsection
