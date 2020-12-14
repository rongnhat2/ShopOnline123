<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The database table permission by the model.
     *
     * @var string
     */
    protected $table = 'permissions';
    protected $fillable = ['name', 'display_name'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }
}
