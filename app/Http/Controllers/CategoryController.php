<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.AjoutCat');
    }

    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'name' => ['required', Rule::unique('categories', 'name')],
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Validate each image file
        ]);
        // Create a new object instance with validated form data
        $slug = Str::slug($validatedData['name']);
        // Create a new object instance with validated form data
        // Store the image file to the public disk
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = $image->storeAs('uploads', $imageName, 'public');

        $object = new Category([
            'name' => $validatedData['name'],
            'slug' => $slug,
            'image' => $imagePath]);

    // Save the object instance to the database
    $object->save();
    // Upload and save each image file
    
    return redirect('/GestionCategorie')->with('success', 'Category added successfully.');
}
}
