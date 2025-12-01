<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Каталог товарів + фільтрація
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Фільтр по категорії
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Пошук
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Фільтр по ціні "від"
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        // Фільтр по ціні "до"
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Пагінація + збереження фільтрів
        $products = $query->paginate(12)->withQueryString();

        // Для списку категорій
        $categories = Category::all();

        return view('catalog.index', compact('products', 'categories'));
    }

    /**
     * Сторінка одного товару
     */
    public function show(Product $product)
    {
        return view('catalog.show', compact('product'));
    }

    /**
     * Порівняння товарів
     */
    public function compare(Request $request)
    {
        $products = Product::all();

        $selected = null;

        if ($request->product1 && $request->product2) {
            $selected = [
                Product::find($request->product1),
                Product::find($request->product2),
            ];
        }

        return view('catalog.compare', compact('products', 'selected'));
    }
}
