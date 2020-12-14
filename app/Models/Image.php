<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The database table images by the model.
     *
     * @var string
     */
    protected $table = 'images';
    protected $fillable = ['name', 'url'];

    public function item(){
        return $this->belongsToMany(Item::class, 'item_image');
    }
    
}
