<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    function index(Request $request){ 
        $sortColumn = $request->get('sort_column', 'name');
        $sortDirection = $request->get('sort_direction', 'asc');
        $products = Product::orderBy($sortColumn, $sortDirection)->paginate(5);
        $totalProducts = Product::count();
        return view('index', compact('products', 'totalProducts', 'sortColumn', 'sortDirection'));
    }

    function create(){
        return view('create');
    }

    function edit($id){
        $product = Product::findOrFail($id);
        return view('edit', ['product' => $product]);
    }

    function show($id){
        $product = Product::findOrFail($id);
        return view('show', ['product' => $product]);
    }

    function store(Request $request){
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input = $request->all();
        $randomId = rand(1000, 9999);
        $productNameSlug = str_replace(' ', '-', strtolower($input['name']));
        $input['product_id'] = $productNameSlug . '-' . $randomId;

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

    function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

       $product = Product::findOrFail($id);
       $input = $request->all();

        unset($input['product_id']);


        if ($image = $request->file('image')) {
            if ($product->image && File::exists('images/' . $product->image)) {
                File::delete('images/' . $product->image);
            }

            $destinationPath = 'images/';
            $profileImage = time() . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }
        // dd($request->name);
        $product->update($input);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    function destroy($id){
        $product = Product::findOrFail($id);
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }    

    function search(Request $request) {
        $query = $request->input('query');
        $products = Product::where('name', 'like', '%' . $query . '%')->orWhere('price', 'like', '%' . $query . '%')->get();
        return response()->json($products);
    }
}
