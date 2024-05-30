<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
            /* margin: 40px auto; */
            /* padding: 10px; */
            height:200px;
        }

        .card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
            max-height: 800px; /* Set the maximum height */

        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            max-width: 300px; /* Set the maximum width */
            max-height: 300px; /* Set the maximum height */
            width: 100%;
            height: auto;
            margin: 70px auto; /* Center the image */
            display: block;
        }

        .card-body {
            padding: 30px;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #333;
        }

        p {
            font-size: 16px;
            margin-bottom: 16px;
            color: #555;
        }

        .price {
            font-size: 24px;
            font-weight: bold;
            color: #ff3d00;
            margin-bottom: 20px;
        }

        .stock {
            color: #388e3c;
            font-weight: bold;
        }

        .warranty {
            color: #1976d2;
            font-weight: bold;
        }

        .btn-main {
            margin-top: 20px;
        }

        .btn-main .input-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-main .input-group input {
            max-width: 80px;
            text-align: center;
        }

        .btn-main .input-group-append button {
            margin-left: 10px;
        }

        @media (max-width: 576px) {
            .card-body {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            .price {
                font-size: 20px;
            }

            .btn-main .input-group {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-main .input-group input,
            .btn-main .input-group-append button {
                width: 100%;
                margin-top: 10px;
            }

            .btn-main .input-group-append button {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
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

<div class="container">
    <div class="card">
        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->title }}">
        <div class="card-body">
            <h1 class="card-title">{{ $product->title }}</h1>
            <p class="card-text">{{ $product->description }}</p>
            <p class="price">Price: ₹{{ $product->price }}</p>
            <p class="stock">Stock: {{ $product->stock }}</p>
            <p class="warranty">Warranty: {{ $product->warranty }}</p>

            <div class="btn-main">
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="input-group">
                        <input type="number" name="quantity" value="1" class="form-control" min="1">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>