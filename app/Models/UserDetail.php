<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    /**
     * The database table user_detail by the model.
     *
     * @var string
     */
    protected $table = 'user_detail';
    protected $fillable = ['user_id', 'telephone', 'birthday', 'address', 'sex'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
