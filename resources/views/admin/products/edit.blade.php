@extends('layouts.app')

@section('content')
<h1>Edit Product</h1>

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.products.partials.form', ['product' => $product])
    <button class="btn btn-primary mt-3">Update</button>
@endsection
