<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The database table role by the model.
     *
     * @var string
     */
    protected $table = 'roles';
    protected $fillable = ['name', 'display_name'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}
