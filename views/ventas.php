<?php
$page_title = "Registro de Ventas";
$current_page = "ventas";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Ventas - CommercePro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        input.cantidad-producto { width: 60px; }
        td.subtotal { font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <?php include '../sidebar.php'; ?>
    <div class="main-content">
        <?php include '../header.php'; ?>

        <div class="form-container">
            <h3 style="margin-bottom: 20px;">Nueva Venta</h3>
            <form id="venta-form">
                <div class="form-group">
                    <label class="form-label" for="codigo-barras">Código de Barras</label>
                    <input type="text" id="codigo-barras" class="form-control" placeholder="Escanear o ingresar código de barras" autofocus>
                </div>

                <div class="table-container">
                    <h4>Productos en Venta</h4>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="productos-venta">
                            <tr>
                                <td colspan="5" style="text-align: center;">No hay productos agregados</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" style="text-align: right; font-weight: bold;">Total:</td>
                                <td id="total-venta" style="font-weight: bold;">$0.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="form-group">
                    <label class="form-label" for="metodo-pago">Método de Pago</label>
                    <select id="metodo-pago" class="form-control">
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta</option>
                        <option value="transferencia">Transferencia</option>
                    </select>
                </div>

                <button type="button" id="procesar-venta" class="btn btn-primary">
                    <i class="fas fa-cash-register"></i> Procesar Venta
                </button>
            </form>
        </div>
    </div>
</div>

<script src="../assets/js/main.js"></script>
<script>
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

// Agregar producto por código de barras
document.getElementById('codigo-barras').addEventListener('keypress', function(e){
    if(e.key === 'Enter'){
        e.preventDefault();
        const codigo = this.value.trim();
        if(!codigo) return;

        const producto = productosDisponibles.find(p => p.codigo === codigo);
        if(!producto){
            alert('Producto no encontrado');
            this.value = '';
            return;
        }

        agregarProductoTabla(producto);
        this.value = '';
    }
});

function agregarProductoTabla(producto) {
    const tbody = document.getElementById('productos-venta');

    // Si estaba la fila "No hay productos agregados", la eliminamos
    if(tbody.querySelectorAll('tr').length === 1 && tbody.querySelector('td[colspan="5"]')){
        tbody.innerHTML = '';
    }

    // Revisar si ya está agregado
    const filaExistente = Array.from(tbody.querySelectorAll('tr')).find(tr => tr.dataset.codigo === producto.codigo);
    if(filaExistente){
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
        <td><input type="number" class="cantidad-producto" value="1"></td>
        <td class="subtotal">$${parseFloat(producto.precio).toFixed(2)}</td>
        <td><button class="btn btn-danger btn-sm btn-eliminar">Eliminar</button></td>
    `;
    tbody.appendChild(tr);

    // Evento cantidad
    // tr.querySelector('.cantidad-producto').addEventListener('input', function(){
    //     if(this.value < 1) this.value = 1;
    //     actualizarSubtotal(tr);
    //     actualizarTotal();
    // });


    // Evento eliminar
    // tr.querySelector('.btn-eliminar').addEventListener('click', function(){
    //     tr.remove();
    //     if(tbody.querySelectorAll('tr').length === 0){
    //         tbody.innerHTML = `<tr><td colspan="5" style="text-align:center;">No hay productos agregados</td></tr>`;
    //     }
    //     actualizarTotal();
    // });

    // actualizarTotal();

    tr.querySelector('.btn-eliminar').addEventListener('click', function(){
    if(confirm(`¿Deseas eliminar "${tr.children[0].textContent}" de la venta?`)){
        tr.remove();
        if(tbody.querySelectorAll('tr').length === 0){
            tbody.innerHTML = `<tr><td colspan="5" style="text-align:center;">No hay productos agregados</td></tr>`;
        }
        actualizarTotal();
    }
});

}

function actualizarSubtotal(tr){
    const precio = parseFloat(tr.children[1].textContent.replace('$',''));
    const cantidad = parseInt(tr.querySelector('.cantidad-producto').value);
    tr.querySelector('.subtotal').textContent = `$${(precio * cantidad).toFixed(2)}`;
}

function actualizarTotal(){
    const tbody = document.getElementById('productos-venta');
    let total = 0;
    tbody.querySelectorAll('tr').forEach(tr=>{
        const subtotalEl = tr.querySelector('.subtotal');
        if(subtotalEl){
            total += parseFloat(subtotalEl.textContent.replace('$','')) || 0;
        }
    });
    document.getElementById('total-venta').textContent = `$${total.toFixed(2)}`;
}

// async function procesarVenta() {
//     const tbody = document.getElementById('productos-venta');
//     const productos = [];

//     tbody.querySelectorAll('tr').forEach(tr => {
//         const cantidadInput = tr.querySelector('.cantidad-producto');
//         if (!cantidadInput) return; // ignora filas vacías
//         const nombre = tr.children[0].textContent.trim();
//         const precio = parseFloat(tr.children[1].textContent.replace('$',''));
//         const cantidad = parseInt(cantidadInput.value) || 1;
//         if(nombre && !isNaN(precio) && cantidad > 0){
//             productos.push({nombre, precio, cantidad});
//         }
//     });

//     if(productos.length === 0){
//         alert('No hay productos para procesar la venta');
//         return;
//     }

//     try {
//         const response = await fetch('../backend/controllers/ventas/postVenta.php', {
//             method: 'POST',
//             headers: {'Content-Type':'application/json'},
//             body: JSON.stringify({
//                 productos,
//                 metodo_pago: document.getElementById('metodo-pago').value
//             })
//         });

//         const result = await response.json();
//         if(result.success){
//             alert(result.message);
//             // Limpiar tabla
//             tbody.innerHTML = `<tr><td colspan="5" style="text-align:center;">No hay productos agregados</td></tr>`;
//             actualizarTotal();
//         } else {
//             alert(result.error || 'Error al procesar la venta');
//         }
//     } catch (error) {
//         console.error(error);
//         alert('Error al procesar la venta');
//     }
// }

async function procesarVenta() {
    const tbody = document.getElementById('productos-venta');
    const productos = [];

    let tieneCero = false;
    let productosCero = [];

    tbody.querySelectorAll('tr').forEach(tr => {
        const cantidadInput = tr.querySelector('.cantidad-producto');
        if (!cantidadInput) return; // Ignora filas vacías
        const nombre = tr.children[0].textContent.trim();
        const precio = parseFloat(tr.children[1].textContent.replace('$',''));
        let cantidad = parseInt(cantidadInput.value);

        if (isNaN(cantidad) || cantidad < 0) cantidad = 0;

        if (cantidad === 0) {
            tieneCero = true;
            productosCero.push(nombre);
        }

        if(nombre && !isNaN(precio) && cantidad > 0){
            productos.push({nombre, precio, cantidad});
        }
    });

    if (tbody.querySelectorAll('tr').length === 0 || productos.length === 0){
        alert('No hay productos para procesar la venta');
        return;
    }

    if (tieneCero){
        alert('Revisa las cantidades de los productos: ' + productosCero.join(', ') + '. No pueden estar en 0.');
        return; // Detenemos el proceso
    }

    try {
        const response = await fetch('../backend/controllers/ventas/postVenta.php', {
            method: 'POST',
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify({
                productos,
                metodo_pago: document.getElementById('metodo-pago').value
            })
        });

        const result = await response.json();
        if(result.success){
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
</script>
</body>
</html>
