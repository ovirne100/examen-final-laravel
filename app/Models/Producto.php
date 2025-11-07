<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // 🗃️ Nombre de la tabla
    protected $table = 'productos';

    // 🧱 Campos asignables
    protected $fillable = ['nombre', 'precio', 'cantidad', 'categoria_id'];

    // ======================
    // 🔗 Relaciones (Includes)
    // ======================
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // ======================
    // 📘 Scopes (Filtros reutilizables)
    // ======================

    public function scopeNombre($query, $nombre)
    {
        if (!empty($nombre)) {
            $query->where('nombre', 'like', "%{$nombre}%");
        }
        return $query;
    }

    public function scopePrecioEntre($query, $min = null, $max = null)
    {
        if (!is_null($min)) {
            $query->where('precio', '>=', $min);
        }
        if (!is_null($max)) {
            $query->where('precio', '<=', $max);
        }
        return $query;
    }

    public function scopeStockBajo($query, $limite = 10)
    {
        return $query->where('cantidad', '<', $limite);
    }

    public function scopeCategoria($query, $categoriaId)
    {
        if (!empty($categoriaId)) {
            $query->where('categoria_id', $categoriaId);
        }
        return $query;
    }
}
