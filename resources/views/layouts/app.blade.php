<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mini E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
.product-image-box {
    width: 100%;
    height: 220px;   /* choose the height you want */
    background: #f5f5f5;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden; 
    border-radius: 6px;
}

.product-image-box img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain; /* show full image, no cut */
}

</style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('shop.index') }}">Mini Shop</a>
        <div>
            <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-sm">
                Cart ({{ count(session('cart', [])) }})
            </a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-light btn-sm ms-2">
                Admin
            </a>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @yield('content')
</div>
</body>
</html>
