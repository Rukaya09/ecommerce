<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Shippings</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Shipment ID</th>
                <th>User</th>
                <th>Full Name</th>
                <th>Address Line 1</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Phone Number</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shipments as $shipment)
            <tr>
                <td>{{ $shipment->id }}</td>
                <td>{{ $shipment->user ? $shipment->user->name : 'N/A' }}</td>
                <td>{{ $shipment->full_name }}</td>
                <td>{{ $shipment->address_line_1 }}</td>
                <td>{{ $shipment->city }}</td>
                <td>{{ $shipment->postal_code }}</td>
                <td>{{ $shipment->phone_number }}</td>
                <td>{{ $shipment->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>