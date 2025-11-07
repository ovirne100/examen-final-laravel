<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'deliveries';
    protected $primaryKey = 'iddelivery';
    protected $fillable = ['gender','birth_date','vehicle_type','profile_photo','users_iduser'];
    public $timestamps = true;

    public function user() { return $this->belongsTo(User::class, 'users_iduser', 'iduser'); }
    public function vehicles() { return $this->hasMany(Vehicle::class, 'deliveries_iddelivery', 'iddelivery'); }
}
