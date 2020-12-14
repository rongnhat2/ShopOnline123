<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /**
     * The database table property by the model.
     *
     * @var string
     */
    protected $table = 'property';
    protected $fillable = ['name'];

    public function item()
    {
        return $this->belongsToMany(Item::class, 'item_property');
    }
}
