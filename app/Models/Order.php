<?php

namespace App\Models;

use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\Shipping;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * Products in order
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('id', 'product_id', 'user_id', 'price', 'quantity')
            ->withTimestamps();
    }

    /**
     * Order line items
     */
    public function order_products(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    /**
     * Shipping relationship (FIX)
     */
    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class);
    }

    /**
     * Scope paid orders
     */
    public function scopePaidOrders($query, $status = 'paid')
    {
        return $query->where('payment_status', $status);
    }
}
