<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $fillable = ['order_id', 'item_id', 'quantity', 'size', 'color', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
