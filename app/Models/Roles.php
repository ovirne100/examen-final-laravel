<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'idrole';
    protected $fillable = ['name'];
    public $timestamps = true;

    public function users() {
        return $this->belongsToMany(User::class, 'roles_users', 'roles_idrole', 'users_iduser');
    }
}
