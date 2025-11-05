<?php 
$page_title = "Gestión de Productos";
$current_page = "productos";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - CommercePro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/productos.css">
</head>
<body>
<div class="container">
    <?php include '../sidebar.php'; ?>
    <div class="main-content">
        <?php include '../header.php'; ?>
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3>Inventario de Productos</h3>
            <button class="btn btn-primary" id="btnAgregarProducto">
                <i class="fas fa-plus"></i> Agregar Producto
            </button>
        </div>
        
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="productos-body">
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" id="modalProducto">
    <div class="modal-content">
        <div class="modal-header" id="modalTitle">Agregar Producto</div>
        <input type="text" id="codigo" placeholder="Código">
        <input type="text" id="nombre" placeholder="Nombre del producto">
        
        <select id="categoria" class="form-control">
            <option value="" disabled selected hidden>Selecciona categoría</option>
        </select>

        <input type="number" id="precio" placeholder="Precio" step="0.01">
        <input type="number" id="stock" placeholder="Stock inicial" min="0">
        <button id="guardarProducto" class="btn btn-primary">Guardar</button>
        <button id="cerrarModal" class="btn btn-warning">Cancelar</button>
    </div>
</div>


<script src="../assets/js/main.js"></script>
<script src="../assets/js/productos.js"></script>
</body>
</html>
