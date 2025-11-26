<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        return view('checkout.index', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        // 1. Create local order (pending)
        $order = Order::create([
            'customer_email' => $request->email,
            'total' => $total,
            'payment_method' => 'stripe',
            'payment_status' => 'pending',
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // 2. Create Stripe checkout session
        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];
        foreach ($cart as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => (int) ($item['price'] * 100),
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'customer_email' => $request->email,
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}&order_id=' . $order->id,
            'cancel_url' => route('checkout.cancel') . '?order_id=' . $order->id,
        ]);

        $order->update([
            'stripe_session_id' => $session->id,
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->update([
            'payment_status' => 'paid',
        ]);

        session()->forget('cart');

        return view('checkout.success', compact('order'));
    }

    public function cancel(Request $request)
    {
        $order = Order::find($request->order_id);
        if ($order) {
            $order->update([
                'payment_status' => 'failed',
            ]);
        }

        return view('checkout.cancel', compact('order'));
    }
}
