<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

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
        $product = Product::create($request->all());
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
        $product->fill($request->all())->save();
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
}
