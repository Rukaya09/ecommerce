<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\categories; // Assuming your category model is named Category
use Illuminate\Support\Facades\Storage; // Import Storage facade for file deletion

class ProductController extends Controller
{
    public function index()
    {
        // Fetch products where category_id is 1
        $products = Product::whereHas('category', function ($query) {
            $query->where('id', 1); // Change the condition as needed
        })->get();

        // Fetch all categories
        $categories = categories::all();

        // Pass products and categories to the view
        return view('welcome', ['products' => $products, 'categories' => $categories]);
    }

    public function showAll()
    {
        $products = Product::all();
        $categories = categories::all();
        return view('products', ['products' => $products, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|string',
            'warranty' => 'nullable|string|max:255',
            'category_id' => 'nullable|numeric', // Correct category_id validation rule
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validatedData = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imageName);
            $validatedData['image'] = 'images/products/'.$imageName;
        }

        Product::create($validatedData);

        return redirect()->back()->with('success', 'Product created successfully!');
    }

    public function showWebsite()
    {
        $products = Product::all();
        $categories = categories::all();
        return view('welcome', ['products' => $products, 'categories' => $categories]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required',
            'warranty' => 'required',
            'category_id' => 'nullable|numeric', // Correct category_id validation rule
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::find($id);
        $product->fill($request->except('image'));

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $imagePath = $request->file('image')->store('product_images');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('products')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    public function jewellery()
{
    // Fetch products where category_id is 3 (assuming jewellery category ID is 3)
    $products = Product::whereHas('category', function ($query) {
        $query->where('id', 2);
    })->get();

    // Fetch all categories
    $categories = categories::all();

    // Pass products and categories to the view
    return view('welcome', ['products' => $products, 'categories' => $categories]);
}
public function fashion()
{
    // Fetch products where category_id is 3 (assuming jewellery category ID is 3)
    $products = Product::whereHas('category', function ($query) {
        $query->where('id', 3);
    })->get();

    // Fetch all categories
    $categories = categories::all();

    // Pass products and categories to the view
    return view('welcome', ['products' => $products, 'categories' => $categories]);
}
public function appliances()
{
    // Fetch products where category_id is 3 (assuming jewellery category ID is 3)
    $products = Product::whereHas('category', function ($query) {
        $query->where('id', 4);
    })->get();

    // Fetch all categories
    $categories = categories::all();

    // Pass products and categories to the view
    return view('welcome', ['products' => $products, 'categories' => $categories]);
}
// ProductController.php
public function show($id)
{
    $product = Product::findOrFail($id);
    return view('productdetails', compact('product'));
}

public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        // Fetch products based on the search query
        $products = Product::where('title', 'like', '%' . $searchQuery . '%')->get();

        // Fetch all categories
        $categories = categories::all();

        // Pass products and categories to the view
        return view('welcome', ['products' => $products, 'categories' => $categories]);
    }


    public function showAllProducts($category_id)
    {
        // Find the category by its ID
        $category = categories::findOrFail($category_id);

        // Get all products belonging to the specified category
        $products = Product::where('category_id', $category_id)->get();

        // Return the view with category and products data
        return view('all_products', compact('category', 'products'));
    }
    public function browse()
{
    $categories = Categories::all();

    $products = Product::all();
    return view('browse-products', compact('products','categories'));
}


public function filter(Request $request)
{
    $categories = Categories::all();


    $maxPrice = $request->input('max_price', 10000); // Default max price if not set

    // Query to get products with price less than or equal to max price
    $products = Product::where('price', '<=', $maxPrice)->get();
    return view('browse-products', compact('categories', 'products'));


}
}