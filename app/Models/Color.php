<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    /**
     * The database table color of item by the model.
     *
     * @var string
     */
    protected $table = 'item_color';
    protected $fillable = ['item_id', 'hex'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function quantitys()
    {
        return $this->hasMany(Quantity::class, 'item_color');
    }
}
