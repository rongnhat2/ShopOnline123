<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    /**
     * The database table quantity of item by the model.
     *
     * @var string
     */
    protected $table = 'item_quantity';
    protected $fillable = ['item_color', 'size', 'quantity'];
    
    public function color()
    {
        return $this->belongsTo(Color::class, 'item_color');
    }
}
