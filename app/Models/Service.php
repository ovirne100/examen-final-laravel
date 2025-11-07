<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'idservice';
    protected $fillable = ['name','description','price','image','categories_idcategory','companies_idcompany'];
    public $timestamps = true;

    public function category() { return $this->belongsTo(Categories::class, 'categories_idcategory', 'idcategory'); }
    public function company() { return $this->belongsTo(Companies::class, 'companies_idcompany', 'idcompany'); }
}
