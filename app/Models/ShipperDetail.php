<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipperDetail extends Model
{
    /**
     * The database table user_detail by the model.
     *
     * @var string
     */
    protected $table = 'shipper_detail';
    protected $fillable = ['shipper_id', 'telephone', 'birthday', 'address', 'sex'];
    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }
}
