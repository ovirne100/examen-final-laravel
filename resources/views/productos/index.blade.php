<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
<div class="container">
    <h1 class="mb-4">Productos</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- FORMULARIO DE FILTROS -->
    <form method="GET" action="{{ route('productos.index') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" name="nombre" value="{{ request('nombre') }}" class="form-control" placeholder="Buscar por nombre">
        </div>
        <div class="col-md-2">
            <input type="number" step="0.01" name="min_precio" value="{{ request('min_precio') }}" class="form-control" placeholder="Precio mínimo">
        </div>
        <div class="col-md-2">
            <input type="number" step="0.01" name="max_precio" value="{{ request('max_precio') }}" class="form-control" placeholder="Precio máximo">
        </div>
        <div class="col-md-3">
            <select name="categoria_id" class="form-select">
                <option value="">Todas las categorías</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1 d-flex align-items-center">
            <input type="checkbox" name="stock_bajo" value="1" {{ request('stock_bajo') ? 'checked' : '' }}>
            <label class="ms-2">Stock bajo</label>
        </div>
        <div class="col-md-1">
            <button class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>

    <a href="{{ route('productos.create') }}" class="btn btn-success mb-3">➕ Nuevo producto</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->categoria?->nombre ?? 'Sin categoría' }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este producto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay productos</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $productos->links() }}
</div>
</body>
</html>
