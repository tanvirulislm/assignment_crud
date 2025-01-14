<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function index(Request $request)
    { 
        $products = Product::all();
        return view('index', ['products' => $products]);
    }

    function create()
    {
        return view('create');
    }

    function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('edit', ['product' => $product]);
    }

    function show($id)
    {
        $product = Product::findOrFail($id);
        return view('show', ['product' => $product]);
    }

    function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $profileImage = $image->store('public/images');
            $input['image'] = basename($profileImage);
        }

        Product::create($input);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    function update(Request $request, Product $product)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            if ($product->image && Storage::exists('public/images/' . $product->image)) {
                Storage::delete('public/images/' . $product->image);
            }
            $profileImage = $image->store('public/images');
            $input['image'] = basename($profileImage);
        } else {
            $input['image'] = $product->image;
        }

        $product->update($input);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    function destroy($id){
        $product = Product::findOrFail($id);
        if ($product->image && Storage::exists('public/images/' . $product->image)) {
            Storage::delete('public/images/' . $product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
