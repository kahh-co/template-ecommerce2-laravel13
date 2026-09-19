<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_number', 'customer_name', 'customer_email',
        'customer_phone', 'address', 'city', 'postal_code', 'note',
        'subtotal', 'shipping', 'total_amount',
        'payment_status', 'order_status', 'payment_reference', 'snap_token',
    ];

    public const PAYMENT_STATUSES = ['pending', 'paid', 'failed', 'expired', 'cancelled'];
    public const ORDER_STATUSES = ['pending', 'processing', 'ready', 'completed', 'cancelled'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
