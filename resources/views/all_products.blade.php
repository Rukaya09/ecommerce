<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Additional Styles -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 40px;
            text-align: center;
            color: #333;
        }

        .card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            width: 100%;
            height: 200px; /* Set a fixed height */
            /* object-fit: cover; Ensure the image covers the container */
            border-bottom: 1px solid #eaeaea;
            object-fit: contain;
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .card-title {
            font-size: 20px;
            margin-bottom: 10px;
            color: #333;
        }

        .card-text {
            font-size: 16px;
            margin-bottom: 15px;
            color: #777;
        }

        .price {
            font-size: 20px;
            font-weight: bold;
            color: #ff3d00;
            margin-bottom: 15px;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group .form-control {
            text-align: center;
        }

        .btn-outline-secondary {
            border-color: #ccc;
            color: #333;
        }

        .btn-outline-secondary:hover {
            background-color: #eaeaea;
        }
    </style>
</head>
<body>
    <div class="container">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif
        <h1>All Products in {{ $category->name }}</h1>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <a href="{{ route('product.details', ['id' => $product->id]) }}">
                            <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->title }}" >
                        </a>
                        <div class="card-body">
                            <h2 class="card-title">
                                <a href="{{ route('product.details', ['id' => $product->id]) }}" class="text-decoration-none">{{ $product->title }}</a>
                            </h2>
                            <b class="card-text price">₹{{ $product->price }}</b>
                            <div class="d-grid gap-2">
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="input-group cart">
                                        <button type="button" class="btn btn-outline-secondary" onclick="decrementQuantity(this)">-</button>
                                        <input type="text" name="quantity" value="1" class="form-control" min="1">
                                        <button type="button" class="btn btn-outline-secondary" onclick="incrementQuantity(this)">+</button>
                                    </div>
                                    <button type="submit" class="btn btn-info">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS and any other scripts -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Additional Scripts -->
    <script>
        function decrementQuantity(button) {
            var input = button.nextElementSibling;
            var value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
            }
        }

        function incrementQuantity(button) {
            var input = button.previousElementSibling;
            input.value = parseInt(input.value) + 1;
        }
    </script>
</body>
</html>