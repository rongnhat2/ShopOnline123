<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The database table item by the model.
     *
     * @var string
     */
    protected $table = 'item';
    protected $fillable = ['category_id', 'image', 'name', 'slug', 'price', 'discount', 'description', 'detail', 'sex', 'view'];

    public function style()
    {
        return $this->belongsToMany(Style::class, 'item_style');
    }
    public function composition()
    {
        return $this->belongsToMany(Composition::class, 'item_composition');
    }
    public function property()
    {
        return $this->belongsToMany(Property::class, 'item_property');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function images()
    {
        return $this->belongsToMany(Image::class, 'item_image');
    }
    public function color()
    {
        return $this->hasMany(Color::class);
    }
    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
