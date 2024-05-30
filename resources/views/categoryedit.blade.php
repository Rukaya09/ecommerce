<!DOCTYPE html>
<html>
<head>
    <style>
        input[type=text], select {
            width: 20%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;

        }

        input[type=submit] {
            width: 100%;
            background-color:blue;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width:100px;
        }

        input[type=submit]:hover {
            background-color: #45a049;
           
        }

        div {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
    </style>
</head>
<body>
<div>
    <h3 style="text-align: center;">Edit Category</h3>
    <form action="{{ route('category.update', ['id' => $category->id]) }}" method="POST" class="border p-4 shadow-sm rounded">

    @csrf
        @method('PUT')
        <label for="categoryName" class="form-label">Category Name:</label>
        <input type="text" name="categories" class="form-control" id="categoryName" value="{{ $category->categories }}" required>
        <input type="submit" value="Update">
    </form>
</div>
</body>
</html>