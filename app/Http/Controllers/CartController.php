<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('cart.index', compact('items'));
    }

    public function add(Request $request, Product $product)
    {
        $item = CartItem::where('user_id', auth()->id())
                        ->where('product_id', $product->id)
                        ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Товар додано в корзину!');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return back()->with('success', 'Кількість оновлено');
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();

        return back()->with('success', 'Товар видалено з корзини');
    }
}
