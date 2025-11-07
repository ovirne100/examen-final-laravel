<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'idcart';
    protected $fillable = ['quantity','users_iduser','products_idproduct','services_idservice'];
    public $timestamps = true;

    public function user() { return $this->belongsTo(User::class, 'users_iduser', 'iduser'); }
    public function product() { return $this->belongsTo(Products::class, 'products_idproduct', 'idproduct'); }
    public function service() { return $this->belongsTo(Service::class, 'services_idservice', 'idservice'); }
}

