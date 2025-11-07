<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'idorder';
    protected $fillable = ['date','name_customer','address','phone','status','quantity','products_idproduct','services_idservice','companies_idcompany','users_iduser'];
    public $timestamps = true;

    public function product() { return $this->belongsTo(Products::class, 'products_idproduct', 'idproduct'); }
    public function service() { return $this->belongsTo(Service::class, 'services_idservice', 'idservice'); }
    public function company() { return $this->belongsTo(Companies::class, 'companies_idcompany', 'idcompany'); }
    public function user() { return $this->belongsTo(User::class, 'users_iduser', 'iduser'); }
}
