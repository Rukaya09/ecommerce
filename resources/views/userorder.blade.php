@include('navbar');

    <div class="container my-orders">
        <h1 style="text-align: center;">My Orders</h1>

        @if(!isset($orders) || $orders->isEmpty())
            <p>No orders found.</p>
        @else
            @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <span><strong>Order ID:</strong> {{ $order->id }}</span>
                        <span><strong>Date:</strong> {{ $order->created_at->format('F j, Y') }}</span>
                    </div>
                    <div class="order-body">
                        <div class="product-image">
                            <img src="{{ $order->product->image }}" alt="{{ $order->product->title }}">
                        </div>
                        <div class="order-details">
                            <p><strong>Product:</strong> {{ $order->product->title }}</p>
                            <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                            <p><strong>Address:</strong> {{ $order->shipment->address_line_1 ?? 'N/A' }}</p>
                            <b><strong>Status:</strong> {{ $order->orderupdates->last()->status ?? 'N/A' }}</b>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

<style>
    .my-orders {
        padding: 20px;
    }
    .order-card {
        border: 1px solid #ddd;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }
    .order-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 14px;
    }
    .order-body {
        display: flex;
    }
    .product-image img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-right: 20px;
    }
    .order-details {
        font-size: 14px;
    }
    .order-details p {
        margin: 0;
        margin-bottom: 5px;
    }
    .order-details strong {
        display: inline-block;
        width: 80px;
    }
</style>