<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';
    protected $primaryKey = 'idvehicle';
    protected $fillable = ['brand','model','year','plate','deliveries_iddelivery'];
    public $timestamps = true;

    public function delivery() { return $this->belongsTo(Delivery::class, 'deliveries_iddelivery', 'iddelivery'); }
}
