document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById('modalProducto');
    const btnAgregar = document.getElementById('btnAgregarProducto');
    const btnCerrar = document.getElementById('cerrarModal');
    const btnGuardar = document.getElementById('guardarProducto');
    const modalTitle = document.getElementById('modalTitle');
    const tbody = document.getElementById('productos-body');

    let editMode = false;
    let editId = null;
    let productosDisponibles = [];

    // Cargar productos disponibles para validaciones
    async function cargarProductosDisponibles() {
        try {
            const response = await fetch('../backend/controllers/productos/getProductos.php');
            productosDisponibles = await response.json();
        } catch (error) {
            console.error('Error al cargar productos disponibles:', error);
        }
    }

    btnAgregar.addEventListener('click', () => {
        editMode = false;
        editId = null;
        modalTitle.textContent = 'Agregar Producto';
        limpiarFormulario();
        modal.style.display = 'flex';
    });

    btnCerrar.addEventListener('click', () => modal.style.display = 'none');

    async function cargarProductos() {
        await cargarProductosDisponibles();
        tbody.innerHTML = '';

        productosDisponibles.forEach(p => {
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
                const producto = productosDisponibles.find(p => p.id === editId);
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

        // Validar código único
        const codigoDuplicado = productosDisponibles.some(p => p.codigo === codigo && (!editMode || p.id !== editId));
        if (codigoDuplicado) {
            alert('Ya existe un producto con ese código de barras. Debes usar otro.');
            return;
        }

        try {
            const url = editMode
                ? '../backend/controllers/productos/putProducto.php'
                : '../backend/controllers/productos/postProducto.php';
            const method = editMode ? 'PUT' : 'POST';
            const bodyData = { codigo, nombre, categoria, precio, stock };
            if (editMode) bodyData.id = editId;

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

    function limpiarFormulario() {
        document.querySelectorAll('#modalProducto input').forEach(input => input.value = '');
    }

    cargarProductos();
});
