@component('mail::message')
# Thank you for your purchase!

### Receipt

**Order ID:** {{ $order->id }}  
**Amount Paid:** ${{ number_format($order->total, 2) }}  
**Payment Method:** Stripe  
**Email:** {{ $order->customer_email }}

@component('mail::button', ['url' => config('app.url')])
Visit Store
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent
