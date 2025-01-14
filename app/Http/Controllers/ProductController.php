<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(Request $request){ 
        $products = Product::all();
        return view('index',['products' => $products]);
    }
    function create(){
        return view('create');
    }
    function edit(){
        return view('edit');
    }
    function show(){
        return view('show');
    }
    function store(Request $request){
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],[
            'required' => 'The :attribute is required.',
        ]);
        
        $input = $request->all();

        // Generate a random product_id
        $randomId = rand(1000, 9999); // Generates a 4-digit random number
        $input['product_id'] = $randomId;
    
        // Append the product_id to the product name
        // $input['name'] = $request->name . '-' . $randomId;
    
        // Handle image upload
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = time() . '.' . $image->extension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }
    
        Product::create($input);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
}
