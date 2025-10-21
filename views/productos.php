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
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
        }
        .modal-header { font-weight: bold; margin-bottom: 10px; }
        .modal input { width: 100%; margin-bottom: 10px; padding: 5px; }
        .modal button { margin-top: 10px; }
    </style>
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
                    <!-- Productos se cargan dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para agregar/editar producto -->
<div class="modal" id="modalProducto">
    <div class="modal-content">
        <div class="modal-header" id="modalTitle">Agregar Producto</div>
        <input type="text" id="codigo" placeholder="Código">
        <input type="text" id="nombre" placeholder="Nombre del producto">
        <input type="text" id="categoria" placeholder="Categoría">
        <input type="number" id="precio" placeholder="Precio" step="0.01">
        <input type="number" id="stock" placeholder="Stock inicial" min="0">
        <button id="guardarProducto" class="btn btn-primary">Guardar</button>
        <button id="cerrarModal" class="btn btn-warning">Cancelar</button>
    </div>
</div>

<script src="../assets/js/main.js"></script>
<script>
const modal = document.getElementById('modalProducto');
const btnAgregar = document.getElementById('btnAgregarProducto');
const btnCerrar = document.getElementById('cerrarModal');
const btnGuardar = document.getElementById('guardarProducto');
const modalTitle = document.getElementById('modalTitle');

let editMode = false;
let editId = null;

btnAgregar.addEventListener('click', () => {
    editMode = false;
    editId = null;
    modalTitle.textContent = 'Agregar Producto';
    modal.style.display = 'flex';
});

btnCerrar.addEventListener('click', () => modal.style.display = 'none');

async function cargarProductos() {
    try {
        const response = await fetch('../backend/controllers/productos/getProductos.php');
        const productos = await response.json();
        const tbody = document.getElementById('productos-body');
        tbody.innerHTML = '';

        productos.forEach(p => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${p.codigo}</td>
                <td>${p.nombre}</td>
                <td>${p.categoria || ''}</td>
                <td>$${parseFloat(p.precio).toFixed(2)}</td>
                <td>${p.stock || 0}</td>
                <td><span class="${(p.stock || 0) > 5 ? 'positive' : 'negative'}">
                        ${(p.stock || 0) > 5 ? 'Disponible' : 'Stock Bajo'}
                    </span></td>
                <td>
                    <button class="btn btn-edit" data-id="${p.id}"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-delete" data-id="${p.id}"><i class="fas fa-trash"></i></button>
                </td>
            `;
            tbody.appendChild(tr);
        });

        // Editar
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', () => {
                editMode = true;
                editId = btn.dataset.id;
                const producto = productos.find(p => p.id === editId);
                document.getElementById('codigo').value = producto.codigo;
                document.getElementById('nombre').value = producto.nombre;
                document.getElementById('categoria').value = producto.categoria;
                document.getElementById('precio').value = producto.precio;
                document.getElementById('stock').value = producto.stock;
                modalTitle.textContent = 'Editar Producto';
                modal.style.display = 'flex';
            });
        });

        // Eliminar
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', async () => {
                if (!confirm('¿Deseas eliminar este producto?')) return;
                const id = btn.dataset.id;
                try {
                    const response = await fetch('../backend/controllers/productos/deleteProducto.php', {
                        method: 'DELETE',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id })
                    });
                    const result = await response.json();
                    if (result.success) cargarProductos();
                    else alert(result.error || 'Error al eliminar producto');
                } catch (e) { console.error(e); alert('Error al eliminar producto'); }
            });
        });

    } catch (error) {
        console.error('Error al cargar productos:', error);
    }
}

btnGuardar.addEventListener('click', async () => {
    const codigo = document.getElementById('codigo').value.trim();
    const nombre = document.getElementById('nombre').value.trim();
    const categoria = document.getElementById('categoria').value.trim();
    const precio = parseFloat(document.getElementById('precio').value);
    const stock = parseInt(document.getElementById('stock').value);

    if (!codigo || !nombre || isNaN(precio) || isNaN(stock)) {
        alert('Completa todos los campos correctamente');
        return;
    }

    try {
        const url = editMode ? '../backend/controllers/productos/putProducto.php' : '../backend/controllers/productos/postProducto.php';
        const method = editMode ? 'PUT' : 'POST';
        const bodyData = { codigo, nombre, categoria, precio, stock };
        if (editMode) bodyData.id = editId; // solo en edición

        const response = await fetch(url, {
            method,
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(bodyData)
        });

        const result = await response.json();
        if (result.success) {
            modal.style.display = 'none';
            cargarProductos();
        } else {
            alert(result.error || 'Error al guardar producto');
        }
    } catch (e) {
        console.error(e);
        alert('Error al guardar producto');
    }
});

cargarProductos();
</script>
</body>
</html>
