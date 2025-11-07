<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    protected $table = 'companies';
    protected $primaryKey = 'idcompany';
    protected $fillable = ['company_name','legal_representative_name','legal_representative_lastname','nit','users_iduser','extra'];
    public $timestamps = true;

    public function categories() {
        return $this->hasMany(Categories::class, 'companies_idcompany', 'idcompany');
    }
    public function products() {
        return $this->hasMany(Products::class, 'companies_idcompany', 'idcompany');
    }
}
