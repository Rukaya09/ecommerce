<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Browse Products</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.css">

    @include('navbar')

    <style>
        .container {
            max-width: 1120px;
            margin-top: 20px;
        }
        .sidebar {
            padding: 20px;
            background: #f7f7f7;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .price-filter h3, .price-filter label, .sort-filter label {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .products {
            display: flex;
            flex-wrap: wrap;
        }
        .product {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
        .product:hover {
            transform: translateY(-5px);
        }
        .product img {
            width: 100%;
            height: auto;
            max-height: 130px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
            margin-bottom: 15px;
        }
        .product-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            flex-grow: 1;
        }
        .product-price {
            font-size: 16px;
            color: #28a745;
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
       .side-bar-holder{
             padding-top: 5rem;
         }
        .container {
            max-width: 1400px;
            margin-top: 20px;
        }
        .sidebar {
            padding:50px;
            background: #f7f7f7;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
           
        }
        .price-filter h3, .price-filter label, .sort-filter label {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .products {
            display: flex;
            flex-wrap: wrap;
        }
        .product {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
        .product:hover {
            transform: translateY(-5px);
        }
        .product img {
            width: 100%;
            height: auto;
            max-height: 130px;
            object-fit: contain;
/* mix-blend-mode:color-burn; */
            border-bottom: 1px solid #ddd;
            margin-bottom: 15px;
        }
        .product-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            flex-grow: 1;
        }
        .product-price {
            font-size: 16px;
            color: #28a745;
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .products-holder{
            text-align: center;
            font-weight: bold;
        }
        .btn-block{
            width: 56%;
            margin-left: 46px;
        }
        .noUi-horizontal .noUi-tooltip{
            left: 7%;
        }
        .h3{
            text-align: center;
            margin-bottom: 40px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-3 side-bar-holder">
            <!-- Sidebar with Filters -->
            <div class="sidebar">
                <div class="price-filter">
                    <h3>Filter by Price</h3>
                    <form action="{{ route('products.filter') }}" method="GET">
                        @csrf
                        <div class="form-group">
                            <label for="price-range">Price Range: <span id="price-range-value"></span></label>
                            <div id="price-range"></div>
                            <input type="hidden" name="min_price" id="min-price" value="{{ request('min_price', 0) }}">
                            <input type="hidden" name="max_price" id="max-price" value="{{ request('max_price', 200000) }}">
                            
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Apply Filters</button>

                        <div class="form-group sort-filter">
                            <label for="sort">Sort By:</label>
                            <select name="sort" id="sort" class="form-control">
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Apply Filters</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <!-- Products Display -->
            <h1 class=" products-holder">All Products</h1>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                        <div class="product">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->title }}">
                            <div class="product-title">{{ $product->title }}</div>
                            <div class="product-price">₹{{ $product->price }}</div>
                            <a href="{{ route('product.details', ['id' => $product->id]) }}" class="btn btn-primary btn-block">View Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Include your footer here -->

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>
<script>
    var priceSlider = document.getElementById('price-range');
    var minPriceInput = document.getElementById('min-price');
    var maxPriceInput = document.getElementById('max-price');
    var priceRangeValue = document.getElementById('price-range-value');

    noUiSlider.create(priceSlider, {
        start: [parseInt(minPriceInput.value), parseInt(maxPriceInput.value)],
        connect: true,
        range: {
            'min': 0,
            'max': 200000
        },
        tooltips: [true, true],
        format: {
            to: function (value) {
                return Math.round(value);
            },
            from: function (value) {
                return Math.round(value);
            }
        }
    });

    priceSlider.noUiSlider.on('update', function(values, handle) {
        minPriceInput.value = values[0];
        maxPriceInput.value = values[1];
        priceRangeValue.textContent = '₹' + values[0] + ' - ₹' + values[1];
    });

    // Set initial value display
    priceRangeValue.textContent = '₹' + priceSlider.noUiSlider.get()[0] + ' - ₹' + priceSlider.noUiSlider.get()[1];
</script>
</body>
</html>