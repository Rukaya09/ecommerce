@include('navbar');


<div class="container">
        <h1>Cart</h1>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        @if($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                        <th>Price</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $grandTotal = 0; // Initialize grand total
                    @endphp
                    @foreach($cartItems as $cartItem)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $cartItem->product->title }}</td>
                            <td><img src="{{ asset($cartItem->product->image) }}" alt="Product Image" style="width: 100px; height: auto;"></td>
               
                            <td>{{ $cartItem->quantity }}</td>
                            <td>
                                <form action="{{ route('cart.delete', $cartItem->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning">Remove</button>
                                </form>
                            </td>
                            <td>{{ $cartItem->product->price }}</td>
                            <td>{{ $cartItem->quantity * $cartItem->product->price }}</td>
                            @php
                                $grandTotal += $cartItem->quantity * $cartItem->product->price; // Calculate grand total
                            @endphp
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" align="right"><strong>Grand Total:</strong></td>
                        <td>{{ $grandTotal }}
                        <form action="{{ route('cart.purchase') }}" method="POST">
    @csrf
    <script src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="{{ config('razorpay.key') }}"
            data-amount="{{ $grandTotal * 100 }}"
            data-currency="INR"
            data-buttontext="Buy Now"
            data-name="test payment"
            data-description="Payment"
            data-prefill.name="{{ $user->name }}"
            data-prefill.email="{{ $user->email }}"
            data-theme.color="#ff7529"
            data-notes="Your custom notes here">
    </script>
</form>

                        </td>
                        
                    </tr>
                </tbody>
            </table>

            <div class="container mt-5">
            <h2>Shipping Address</h2>
    
    <!-- Flash Messages -->
    @if(session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
    @endif

            <div id="shippingFormContainer">
                <form id="shippingForm" method="POST" action="{{ route('shipping.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" name="full_name" class="form-control" id="full_name" required>
                    </div>

                    <div class="form-group">
                        <label for="address_line_1">Address Line 1</label>
                        <input type="text" name="address_line_1" class="form-control" id="address_line_1" required>
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" name="city" class="form-control" id="city">
                    </div>

                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" name="postal_code" class="form-control" id="postal_code">
                    </div>

                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" id="phone_number">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <div id="shippingInfo" style="display: none;"></div>
        @endif
    </div>
</div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shippingFormContainer = document.getElementById('shippingFormContainer');
            const shippingForm = document.getElementById('shippingForm');
            const shippingInfo = document.getElementById('shippingInfo');

            shippingForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Perform AJAX request to submit form data
                fetch(shippingForm.action, {
                    method: 'POST',
                    body: new FormData(shippingForm),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.errors) {
                        // Handle validation errors
                        console.error(data.errors);
                        return;
                    }

                    // Hide the form
                    shippingFormContainer.style.display = 'none';
                    // Display the shipping information
                    shippingInfo.innerHTML = `
                        <p>Full Name: ${data.full_name}</p>
                        <p>Address: ${data.address_line_1}, ${data.city}, ${data.postal_code}</p>
                        <p>Phone Number: ${data.phone_number}</p>
                    `;
                    shippingInfo.style.display = 'block'; // Show the shipping information section

                    // Enable Razorpay button after shipping info is submitted
                    document.getElementById('razorpayButton').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    </script>

       
 
