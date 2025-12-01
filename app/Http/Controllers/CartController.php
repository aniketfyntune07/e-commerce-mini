<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    //

    public function index(){
        
      $cart = session()->get('cart', []);
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product){
        $cart = session()->get('cart',[]);

        if(isset($cart[$product->id])){
            $cart[$product->id]['quantity']++;
        }else{
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        session()->put('cart',$cart);

        return redirect()->back()->with('success','Product added to cart');

    }

    public  function update(Request $request, Product $product){
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $quantity = $request->quantity;
        $cart = session()->get('cart',[]);

        if (! isset($cart[$product->id])) {
            return redirect()->back()->with('error', 'Item not found in cart.');
        }

        // Product out of stock
        
        if($product->stock <= 0){
            unset($cart[$product->id]);
            session()->put('cart',$cart);
            return redirect()->back()->with('error','Product is out of stock');
        }

        // Quantity exceeding available stock

        if($quantity > $request->stock){
            $cart[$product->id]['quantity'] = $product->stock;
            session()->put('cart',$cart);
            return redirect()->back()->with('error','Quantity exceeding available stock ({$product->stock}).');
        }

        // Normal update

        $cart[$product->id]['quantity'] = $quantity;
        session()->put('cart',$cart);
        return redirect()->back()->with('success','Cart updated');
    }

    public function remove(Product $product){
        $cart = session()->get('cart',[]);

         if(isset($cart[$product->id])){
           unset($cart[$product->id]);
           session()->put('cart', $cart);
        }

        return redirect()->back()->with('success','Item removed from cart');
    }

    public function clear(){
         session()->forget('cart');
         return redirect()->back()->with('success','Cart cleared');
    }
}
