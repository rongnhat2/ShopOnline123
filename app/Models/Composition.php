<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Composition extends Model
{
    /**
     * The database table composition by the model.
     *
     * @var string
     */
    protected $table = 'composition';
    protected $fillable = ['name'];

    public function item()
    {
        return $this->belongsToMany(Item::class, 'item_composition');
    }
}
