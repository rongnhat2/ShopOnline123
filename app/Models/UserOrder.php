<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    /**
     * The database table style by the model.
     *
     * @var string
     */
    protected $table = 'user_order';
    protected $fillable = ['user_id', 'order_id', 'shipper_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
