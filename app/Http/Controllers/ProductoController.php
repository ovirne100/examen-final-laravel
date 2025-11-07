<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * 🧾 Listar productos con filtros (scope + include)
     */
    public function index(Request $request)
    {
        $nombre = $request->input('nombre');
        $minPrecio = $request->input('min_precio');
        $maxPrecio = $request->input('max_precio');
        $stockBajo = $request->boolean('stock_bajo');
        $categoriaId = $request->input('categoria_id');

        $productos = Producto::with('categoria') // include (relación)
            ->nombre($nombre)
            ->precioEntre($minPrecio, $maxPrecio)
            ->categoria($categoriaId)
            ->when($stockBajo, fn($q) => $q->stockBajo())
            ->orderBy('id', 'desc')
            ->paginate(10); // ✅ paginación

        $categorias = Categoria::all();

        return view('productos.index', compact('productos', 'categorias'));
    }

    /**
     * 🆕 Mostrar formulario de creación
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    /**
     * 💾 Guardar producto
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', '✅ Producto creado correctamente.');
    }

    /**
     * ✏️ Formulario de edición
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * 🔄 Actualizar producto
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', '✅ Producto actualizado correctamente.');
    }

    /**
     * ❌ Eliminar producto
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', '🗑️ Producto eliminado correctamente.');
    }
}
