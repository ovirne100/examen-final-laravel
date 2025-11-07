<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'idproduct';
    protected $fillable = [
        'name','description','price','quantity','image','categories_idcategory','companies_idcompany'
    ];
    public $timestamps = true;

    // includes
    public function category() {
        return $this->belongsTo(Categories::class, 'categories_idcategory', 'idcategory');
    }
    public function company() {
        return $this->belongsTo(Companies::class, 'companies_idcompany', 'idcompany');
    }

    // SCOPES - filters and sort & include  para filtros dinamicos en la consulta.
    public function scopeFilter($query, array $filters) {
        $query->when($filters['name'] ?? null, fn($q,$v) => $q->where('name','like',"%{$v}%"));
        $query->when($filters['category_id'] ?? null, fn($q,$v) => $q->where('categories_idcategory',$v));
        $query->when($filters['company_id'] ?? null, fn($q,$v) => $q->where('companies_idcompany',$v));
        $query->when(isset($filters['price_min']) && $filters['price_min'] !== null, fn($q,$v) => $q->where('price','>=',$v), $filters['price_min'] ?? null);
        $query->when(isset($filters['price_max']) && $filters['price_max'] !== null, fn($q,$v) => $q->where('price','<=',$v), $filters['price_max'] ?? null);
        $query->when(isset($filters['stock_below']) && $filters['stock_below'] !== null, fn($q,$v) => $q->where('quantity','<',$v), $filters['stock_below'] ?? null);
        return $query;
    }

    // sort: sirve para ordenar los resultados por una columna especifica
    public function scopeSort($query, $sort) {
        if (!$sort) return $query;
        $direction = str_starts_with($sort,'-') ? 'desc' : 'asc';
        $column = ltrim($sort,'-');
        $allowed = ['name','price','quantity','created_at','idproduct'];
        if (in_array($column, $allowed)) {
            $query->orderBy($column, $direction);
        }
        return $query;
    }

    // include incluir relaciones de category y company en la consulta
    public function scopeInclude($query, $include) {
        if (!$include) return $query;
        $rels = array_map('trim', explode(',', $include));
        $valid = array_intersect($rels, ['category','company']);
        if (!empty($valid)) $query->with($valid);
        return $query;
    }
}
