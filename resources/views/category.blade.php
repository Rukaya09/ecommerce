@include('layouts.sidebar');

    <title>Category Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-table th, .custom-table td {
            padding: 12px;
            text-align: center;
        }
        .custom-table th {
 background-color: #E4E4D0;
        }
        .custom-table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        .custom-table tbody tr:hover {
            background-color: #e9ecef;
        }
        .btn-group {
            display: flex;
            justify-content: center;
        }
        
        .btn-group button{

    }
        .btn-group form {
            margin: 0 5px;
        }
        .form-group input{
            background-color:#F5F7F8;
            padding:12px;

        }
    </style>
</head>
<body>

<div class="container ">
    <form action="{{ route('category.store') }}" method="POST" class="border p-4 shadow-sm rounded">
        @csrf
        <div class="form-group">
            <label for="categoryName" class="form-label"><h4>Category Name:</h4></label>
            <input type="text" name="categories" class="form-control" id="categoryName" placeholder="Enter category name" required>
        </div>
        <button type="submit" class="btn btn-primary custom-button">Add Product</button>

<style>
.custom-button {
    width: 40%; /* Adjust the width as needed */
    margin-left: 25%; /* Adds margin on top, bottom, left, and right */
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
</style>    </form>
</div>

<div class="container mt-5">
    <h3 class="text-center"    >All Categories</h3>
    <table class="table table-bordered custom-table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->categories }}</td>
                    <td class="btn-group">
                        <form action="{{ route('category.edit', $category->id) }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-primary"style="background-color:#028391 !important">Edit</button>


                            
                        </form>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                        </form>
                    </td>
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
