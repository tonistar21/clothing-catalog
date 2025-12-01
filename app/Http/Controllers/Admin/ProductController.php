<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'desc')->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'price'       => 'required|numeric',
            'category_id' => 'required',
            'image'       => 'nullable|image|max:2048',
        ]);

        $img = null;

        if ($request->hasFile('image')) {
            $img = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $img,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Товар створено!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required',
            'price'       => 'required|numeric',
            'category_id' => 'required',
        ]);

        $img = $product->image;

        if ($request->hasFile('image')) {
            $img = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $img,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Товар оновлено!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Товар видалено!');
    }
}
