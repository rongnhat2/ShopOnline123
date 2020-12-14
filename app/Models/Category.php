<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table category by the model.
     *
     * @var string
     */
    protected $table = 'category';
    protected $fillable = ['name', 'slug'];

    public function item()
    {
        return $this->hasOne(Item::class);
    }
}
