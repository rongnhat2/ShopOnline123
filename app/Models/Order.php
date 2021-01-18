<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = ['code', 'prices', 'status', 'payment', 'order_time'];

    public function user_order()
    {
        return $this->hasMany(UserOrder::class);
    }
    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
