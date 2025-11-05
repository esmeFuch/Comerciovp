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
    <link rel="stylesheet" href="../assets/css/ventas.css">
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

<!-- Scripts -->
<script src="../assets/js/main.js"></script>
<script src="../assets/js/ventas.js"></script>
</body>
</html>
