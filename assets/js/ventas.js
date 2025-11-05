let productosDisponibles = [];

// Cargar todos los productos al iniciar
async function cargarProductosDisponibles() {
    try {
        const response = await fetch('../backend/controllers/productos/getProductos.php');
        productosDisponibles = await response.json();
    } catch (error) {
        console.error('Error al cargar productos disponibles:', error);
    }
}

// Agregar producto por código de barras usando Enter
document.getElementById('codigo-barras').addEventListener('keypress', async function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        const codigo = this.value.trim();
        if (!codigo) return;

        try {
            const response = await fetch(`../backend/controllers/productos/getProductoByCodigo.php?codigo=${codigo}`);
            const data = await response.json();

            if (!data.success || !data.producto) {
                alert('Producto no encontrado');
                this.value = '';
                return;
            }

            agregarProductoTabla(data.producto);
            this.value = '';
        } catch (error) {
            console.error(error);
            alert('Error al buscar el producto');
        }
    }
});

// Agregar producto a la tabla
function agregarProductoTabla(producto) {
    const tbody = document.getElementById('productos-venta');

    // Si estaba la fila "No hay productos agregados", la eliminamos
    if (tbody.querySelectorAll('tr').length === 1 && tbody.querySelector('td[colspan="5"]')) {
        tbody.innerHTML = '';
    }

    // Revisar si ya está agregado
    const filaExistente = Array.from(tbody.querySelectorAll('tr')).find(tr => tr.dataset.codigo === producto.codigo);
    if (filaExistente) {
        const cantidadInput = filaExistente.querySelector('.cantidad-producto');
        cantidadInput.value = parseInt(cantidadInput.value) + 1;
        actualizarSubtotal(filaExistente);
        actualizarTotal();
        return;
    }

    const tr = document.createElement('tr');
    tr.dataset.codigo = producto.codigo;
    tr.innerHTML = `
        <td>${producto.nombre}</td>
        <td>$${parseFloat(producto.precio).toFixed(2)}</td>
        <td><input type="number" class="cantidad-producto" value="1" min="1"></td>
        <td class="subtotal">$${parseFloat(producto.precio).toFixed(2)}</td>
        <td><button type="button" class="btn btn-danger btn-sm btn-eliminar">Eliminar</button></td>
    `;
    tbody.appendChild(tr);

    // Evento cantidad
    tr.querySelector('.cantidad-producto').addEventListener('input', () => {
        let val = parseInt(tr.querySelector('.cantidad-producto').value);
        if (isNaN(val) || val < 1) val = 1;
        tr.querySelector('.cantidad-producto').value = val;
        actualizarSubtotal(tr);
        actualizarTotal();
    });

    actualizarTotal();
}

// Delegación para eliminar productos de la venta
document.getElementById('productos-venta').addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-eliminar')) {
        const tr = e.target.closest('tr');
        const codigo = tr.dataset.codigo;

        if (!confirm(`¿Deseas eliminar "${tr.children[0].textContent}" de la venta?`)) return;

        // Llamada al backend para eliminar
        fetch(`../backend/controllers/ventas/deleteVenta.php?codigo=${codigo}`)
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    tr.remove();
                    const tbody = document.getElementById('productos-venta');
                    if (tbody.querySelectorAll('tr').length === 0) {
                        tbody.innerHTML = `<tr><td colspan="5" style="text-align:center;">No hay productos agregados</td></tr>`;
                    }
                    actualizarTotal();
                } else {
                    alert(data.error || 'No se pudo eliminar el producto');
                }
            })
            .catch(err => console.error(err));
    }
});

// Actualizar subtotal de una fila
function actualizarSubtotal(tr) {
    const precio = parseFloat(tr.children[1].textContent.replace('$', ''));
    const cantidad = parseInt(tr.querySelector('.cantidad-producto').value);
    tr.querySelector('.subtotal').textContent = `$${(precio * cantidad).toFixed(2)}`;
}

// Actualizar total de la venta
function actualizarTotal() {
    const tbody = document.getElementById('productos-venta');
    let total = 0;
    tbody.querySelectorAll('tr').forEach(tr => {
        const subtotalEl = tr.querySelector('.subtotal');
        if (subtotalEl) total += parseFloat(subtotalEl.textContent.replace('$', '')) || 0;
    });
    document.getElementById('total-venta').textContent = `$${total.toFixed(2)}`;
}

// Procesar venta
async function procesarVenta() {
    const tbody = document.getElementById('productos-venta');
    const productos = [];
    let tieneCero = false;
    let productosCero = [];

    tbody.querySelectorAll('tr').forEach(tr => {
        const cantidadInput = tr.querySelector('.cantidad-producto');
        if (!cantidadInput) return;

        const codigo = tr.dataset.codigo;
        const nombre = tr.children[0].textContent.trim();
        const precio = parseFloat(tr.children[1].textContent.replace('$', ''));
        let cantidad = parseInt(cantidadInput.value);

        if (isNaN(cantidad) || cantidad < 0) cantidad = 0;

        if (cantidad === 0) {
            tieneCero = true;
            productosCero.push(nombre);
        }

        if (nombre && !isNaN(precio) && cantidad > 0) {
            productos.push({ codigo, nombre, precio, cantidad });
        }
    });

    if (tbody.querySelectorAll('tr').length === 0 || productos.length === 0) {
        alert('No hay productos para procesar la venta');
        return;
    }

    if (tieneCero) {
        alert('Revisa las cantidades de los productos: ' + productosCero.join(', ') + '. No pueden estar en 0.');
        return;
    }

    try {
        const response = await fetch('../backend/controllers/ventas/postVenta.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                productos,
                metodo_pago: document.getElementById('metodo-pago').value
            })
        });

        const result = await response.json();
        if (result.success) {
            alert(result.message);
            tbody.innerHTML = `<tr><td colspan="5" style="text-align:center;">No hay productos agregados</td></tr>`;
            actualizarTotal();
        } else {
            alert(result.error || 'Error al procesar la venta');
        }
    } catch (error) {
        console.error(error);
        alert('Error al procesar la venta');
    }
}

document.getElementById('procesar-venta').addEventListener('click', procesarVenta);

cargarProductosDisponibles();
