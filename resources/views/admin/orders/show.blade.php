@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Order #{{ $order->id }}</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <p><strong>Customer Email:</strong> {{ $order->customer_email }}</p>
            <p><strong>Total:</strong> ${{ $order->total }}</p>
            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
            <p><strong>Status:</strong> 
                <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </p>

            @if($order->stripe_session_id)
                <p><strong>Stripe Session ID:</strong> {{ $order->stripe_session_id }}</p>
            @endif

            @if($order->paypal_order_id)
                <p><strong>PayPal Order ID:</strong> {{ $order->paypal_order_id }}</p>
            @endif

            <p><strong>Created At:</strong> {{ $order->created_at }}</p>
            <p><strong>Updated At:</strong> {{ $order->updated_at }}</p>
        </div>
    </div>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
        Back to Orders
    </a>
</div>
@endsection
