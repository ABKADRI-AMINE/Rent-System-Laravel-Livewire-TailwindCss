<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ObjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all(); 
        $products = Product::where('user_id',auth()->id())->get();
        return view('partenaire.listeObject',compact('products' ,'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all() ;
        return view('partenaire.ajouterObjet' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'category_id' => 'required',
            'title' => ['required', Rule::unique('products', 'title')],
            'description' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Validate each image file
        ]);
        $validatedData['user_id'] = auth()->id();
        // Create a new object instance with validated form data
        $slug = Str::slug($validatedData['title']);
        // Create a new object instance with validated form data
        $object = new Product([
            'category_id' => $validatedData['category_id'],
            'title' => $validatedData['title'],
            'slug' => $slug,
            'description' => $validatedData['description'],
            'user_id' => $validatedData['user_id']
        ]);

    // Save the object instance to the database
    $object->save();
    // Upload and save each image file
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads', $imageName, 'public');
            $image = new Image([
                'product_id' => $object->id,
                'imageName' => $imagePath
            ]);
            $image->save();
        }
    }
    return redirect()->back()->with('message' , 'Object Added Succecfuly');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $images=Image::all();
        $categories = Category::all();
        $product=Product::findOrFail($id);
        return view('partenaire.modifierObjet', compact('product','categories','images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // Retrieve the object to be updated
       $object = Product::findOrFail($id);
    
       // Validate form data
       $validatedData = $request->validate([
           'category_id' => 'required',
           'title' => ['required', Rule::unique('products', 'title')->ignore($object->id)],
           'description' => 'required',
           'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Validate each image file
       ]);
   
       // Update object with validated form data
       $object->category_id = $validatedData['category_id'];
       $object->title = $validatedData['title'];
       $object->description = $validatedData['description'];
       $object->user_id = auth()->id();
       $object->save();
   
       // Delete any images that were unchecked
       $uncheckedImages = collect($request->input('images'))->diff($object->image->pluck('id')->toArray());
       Image::whereIn('id', $uncheckedImages)->delete();
   
       // Upload and save each new image file
       if ($request->hasFile('images')) {
           foreach ($request->file('images') as $image) {
               $imageName = time() . '_' . $image->getClientOriginalName();
               $imagePath = $image->storeAs('uploads', $imageName, 'public');
               $image = new Image([
                   'product_id' => $object->id,
                   'imageName' => $imagePath
               ]);
               $image->save();
               
}
    }
    return redirect('/listeObject')->with('message','products deleted succcessfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        if($product->user_id!=auth()->id()){
        abort(403 , 'Unauthorized Action');
        }
       $product->delete();
       return redirect('/listeObject')->with('message','products deleted succcessfully!!');
    }
}
