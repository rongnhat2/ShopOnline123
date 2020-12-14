<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    /**
     * The database table carousel by the model.
     *
     * @var string
     */
    protected $table = 'carousel';
    protected $fillable = ['image', 'title', 'detail'];

}
