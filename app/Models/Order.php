<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'customer_email',
        'total',
        'payment_method',
        'payment_status',
        'stripe_session_id',
        'paypal_order_id',
    ];

    public function items(){
        return $this->hasMany(OrderItem::class);
    }
}
