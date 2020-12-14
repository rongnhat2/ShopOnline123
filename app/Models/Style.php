<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    /**
     * The database table style by the model.
     *
     * @var string
     */
    protected $table = 'style';
    protected $fillable = ['name'];

    public function item()
    {
        return $this->belongsToMany(Role::class, 'item_style');
    }
}
