<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'idcategory';
    protected $fillable = ['name','description','companies_idcompany'];
    public $timestamps = true;

    public function company() {
        return $this->belongsTo(Companies::class, 'companies_idcompany', 'idcompany');
    }

    public function products() {
        return $this->hasMany(Products::class, 'categories_idcategory', 'idcategory');
    }

    // scope: search by name
    public function scopeNombre($query, $nombre) {
        if (!empty($nombre)) $query->where('name','like',"%{$nombre}%");
    }
}
