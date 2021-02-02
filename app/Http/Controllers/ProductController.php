<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('products.index')->with('products', $products);
    }

    public function create()
    {
        $product = new Product();
        return view('products.edit')->with('product', $product);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->allValidated());
        return redirect()->route('products.show', $product);
    }

    public function show(Product $product)
    {
        return view('products.show')->with('product', $product);
    }

    public function edit(Product $product)
    {
        return view('products.edit')->with('product', $product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->fill($request->allValidated())->save();
        return redirect()->route('products.show', $product);
    }

    public function remove(Product $product)
    {
        return view('products.remove')->with('product', $product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function tagging(Request $request, Product $product)
    {
        $request->validate(['tag_id' => 'required|exists:tags,id']);
        if( $request->method() == 'POST' ) $product->tags()->attach($request->tag_id);
        elseif( $request->method() == 'DELETE' ) $product->tags()->detach($request->tag_id);
        return redirect()->route('products.show', $product);
    }
}
