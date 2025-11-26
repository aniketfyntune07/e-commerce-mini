@extends('layouts.app')

@section('content')
<h1>Add Product</h1>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.products.partials.form', ['product' => null])
    <button class="btn btn-primary mt-3">Save</button>
</form>
@endsection
