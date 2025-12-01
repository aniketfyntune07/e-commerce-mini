<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Jobs\SendReceiptEmailJob;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $event = $request->all();

        if ($event['type'] === 'checkout.session.completed') {

            $session = $event['data']['object'];

            // Create order
            $order = Order::create([
                'customer_email'     => $session['customer_details']['email'],
                'total'              => $session['amount_total'] / 100,
                'payment_method'     => 'stripe',
                'payment_status'     => 'paid',
                'stripe_session_id'  => $session['id'],
            ]);

            // Dispatch email job
            SendReceiptEmailJob::dispatch($order);
        }

        return response('Webhook received', 200);
    }
}
