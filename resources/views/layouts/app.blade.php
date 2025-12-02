<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mini E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-image-box {
            width: 100%;
            height: 220px;
            /* choose the height you want */
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
            object-fit: contain;
            /* show full image, no cut */
        }
    </style>

</head>

<body>


    @if (!in_array(Request::route()->getName(), ['login', 'register']))
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
            <div class="container">
                @if(auth()->user()->isAdmin())
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Mini Shop</a>
                @endif
                @if(!auth()->user()->isAdmin())
                <a class="navbar-brand" href="{{ route('shop.index') }}">Mini Shop</a>
                @endif
                <div class="d-flex align-items-center">
                    @if(!Auth()->User()->isAdmin())
                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-sm me-2">
                        Cart ({{ count(session('cart', [])) }})
                    </a>
                    @endif

                    <!-- Admin Login -->
                    <!-- <a href="{{ route('admin.login') }}" class="btn btn-outline-warning btn-sm me-2">
                        Admin Login
                    </a> -->

                    <!-- Admin dashboard -->
                      <!-- @if(Auth()->User()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm me-2">
                        Dashboard
                    </a>
                    @endif -->

                    @guest
                        <!-- User Login -->
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">
                            Login
                        </a>

                        <!-- User Register -->
                        <a href="{{ route('register') }}" class="btn btn-light btn-sm">
                            Register
                        </a>
                    @else
                        <!-- Logged-in user -->
                        <!-- <span class="text-white me-2">
                            Hello, {{ Auth::user()->name }}
                        </span> -->

                        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">
                            Logout
                        </a>
                    @endguest

                </div>
            </div>
        </nav>
    @endif

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