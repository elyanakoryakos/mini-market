<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        return view('cart.index', compact('cart','total'));
    }

    public function add(Request $request, Product $product)
    {
        $qty = $request->validate([
            'quantity' => 'nullable|integer|min:1|max:100'
        ])['quantity'] ?? 1;

        $cart = session('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += $qty;
        } else {
            $cart[$product->id] = [
                'name'  => $product->name,
                'price' => $product->price,
                'qty'   => $qty,
            ];
        }
        session(['cart'=>$cart]);

        return back()->with('success','Added to cart.');
    }

    public function update(Request $request, Product $product)
    {
        $qty = $request->validate([
            'quantity' => 'required|integer|min:1|max:100'
        ])['quantity'];

        $cart = session('cart', []);
        if (!isset($cart[$product->id])) {
            return back()->with('error','Item not found in cart.');
        }

        $cart[$product->id]['qty'] = $qty;
        session(['cart'=>$cart]);

        return redirect()->route('cart.index')->with('success','Cart updated.');
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart'=>$cart]);

        return redirect()->route('cart.index')->with('success','Item removed.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success','Cart cleared.');
    }
}
