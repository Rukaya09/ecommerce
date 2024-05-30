<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::all(); // Fetch all categories
        return view('category', compact('categories'));
        
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'categories' => 'required|string|max:255',
        ]);

        $category = new Categories;
        $category->categories = $request->categories;
        $category->save();

        return redirect()->back()->with('success', 'Category created successfully');
    }
    public function edit($id)
    {
        $category = Categories::find($id);
        return view('categoryedit', compact('category'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'categories' => 'required|string|max:255',
        ]);

        $category = Categories::find($id);
        $category->categories = $request->categories;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
    public function showForm()
    {
        // Retrieve all categories from the database
        $categories = Categories::all();
        
        // Pass categories to the view
        return view('navbar', compact('categories'));
    }

    }