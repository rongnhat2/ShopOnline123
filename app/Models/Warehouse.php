<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    /**
     * The database table style by the model.
     *
     * @var string
     */
    protected $table = 'warehouse';
    protected $fillable = ['user_id', 'name', 'color', 'size', 'quantity'];
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }
}
