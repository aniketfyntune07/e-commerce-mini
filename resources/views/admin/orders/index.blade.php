@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Customer Orders</h2>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Total</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_email }}</td>
                        <td>${{ $order->total }}</td>
                        <td>{{ ucfirst($order->payment_method) }}</td>
                        <td>
                            <span class="badge 
                                {{ $order->payment_status === 'paid' ? 'bg-success' : 'bg-warning' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" 
                               class="btn btn-sm btn-primary">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $orders->links() }}
    </div>
</div>
@endsection
