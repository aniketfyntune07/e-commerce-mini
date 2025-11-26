@extends('layouts.app')

@section('content')
<h1>Payment Successful ✅</h1>
<p>Thank you! Your order #{{ $order->id }} has been paid.</p>
<a href="{{ route('shop.index') }}" class="btn btn-primary mt-3">Back to Shop</a>
@endsection
