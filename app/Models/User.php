<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'iduser';
    protected $fillable = ['name','lastname','email','country','phone','password'];
    protected $hidden = ['password'];

    public function roles() {
        return $this->belongsToMany(Role::class, 'roles_users', 'users_iduser', 'roles_idrole');
    }

    public function companies() {
        return $this->hasMany(Companies::class, 'users_iduser', 'iduser');
    }
}
