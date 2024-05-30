@include('layouts.sidebar');
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information Form</title>
    <!-- Bootstrap CSS -->

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- <style>
    .custom-table-width {
        width: 150%;
    }
</style> -->
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-4 mb-4" style="text-align: center;">Product Information Form</h2>

                <!-- Form starts here -->
                <div class="form-container" style="max-width: 1000px; margin-left:200px;">
                    <!-- Set the max-width here -->
                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row"style="margin-right:22%">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter product title">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"
                                        placeholder="Enter product description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input type="text" class="form-control" id="price" name="price"
                                        placeholder="Enter product price">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock">Stock:</label>
                                    <input type="text" class="form-control" id="stock" name="stock"
                                        placeholder="Enter product stock">
                                </div>
                                <div class="form-group">
                                    <label for="warranty">Warranty:</label>
                                    <input type="text" class="form-control" id="warranty" name="warranty"
                                        placeholder="Enter product warranty">
                                </div>
                                <div class="form-group">
                                    <label for="category">Category:</label>
                                    <select class="form-control" id="category" name="category_id">
                                        <option value="">Select category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->categories }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="image">Product Image:</label>
                                    <input type="file" class="form-control-file" id="image" name="image">
                                    <small id="imageHelp" class="form-text text-muted">Upload an image for the
                                        product.</small>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary custom-button">Add Product</button>

<style>
.custom-button {
    width: 80%; /* Adjust the width as needed */
    margin-left: 20px auto; /* Adds margin on top, bottom, left, and right */
    display: block; /* Centers the button horizontally */
    padding: 10px 20px;
    font-size: 16px;
    background-color: #007bff;
    border-color: #007bff;
    border-radius: 5px;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

.custom-button:hover {
    background-color: #0056b3;
    border-color: #004085;
}
</style>
                    </form>
                </div>
                <!-- Form ends here -->
            </div>
        </div>
    </div>
    </div>

    <div class="container" style="width: 100%; margin-right:5;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2 class="mt-4 mb-4">Product List</h2>
                <div class="table-responsive">
                    <table class="table table-bordered custom-table-width ">


                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Warranty</th>
                                <th>Categories</th>
                                <th>Image</th>
                                <th>Actions</th> <!-- New column for action buttons -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->warranty }}</td>
                                <td>{{ $product->category->categories }}</td>
                                <td>
                                    @if ($product->image)
                                    <img src="{{ asset($product->image) }}" alt="Product Image"
                                        style="max-width: 100px;">
                                    @else
                                    No Image
                                    @endif
                                </td>
                                <td>
                                    <div class="class" style="display:flex">
                                        <!-- Edit Button -->
                                        <a href="{{ route('product.edit', $product->id) }}"
   class="btn btn-sm btn-primary mr-2 disp"
   style="background-color:#028391 !important;">
   <i class="bi bi-pencil-fill"></i> Edit
</a>


                                        <!-- Delete Button -->
                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                                <i class="bi bi-trash-fill"></i> Delete
                                            </button>
                                        </form>
                                </td>
                </div>
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>

        </div>
        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>