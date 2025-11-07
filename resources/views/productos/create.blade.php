<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h1>Nuevo Producto</h1>
        <form action="{{ route('productos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Precio</label>
                <input type="number" name="precio" class="form-control" required step="0.01">
            </div>
            <div class="mb-3">
                <label>Cantidad</label>
                <input type="number" name="cantidad" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</body>
</html>



