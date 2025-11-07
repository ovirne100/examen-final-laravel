<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h1>Editar Producto</h1>
        <form action="{{ route('productos.update', $producto->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Precio</label>
                <input type="number" name="precio" value="{{ $producto->precio }}" class="form-control" required step="0.01">
            </div>
            <div class="mb-3">
                <label>Cantidad</label>
                <input type="number" name="cantidad" value="{{ $producto->cantidad }}" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</body>
</html>
