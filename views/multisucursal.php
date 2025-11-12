<?php
$page_title = "Gestión Multisucursal";
$current_page = "multisucursal";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multisucursal - CommercePro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/multisucursal.css">
</head>
<body>
<div class="container">
    <?php include '../sidebar.php'; ?>
    <div class="main-content">
        <?php include '../header.php'; ?>

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h3>Gestión Multisucursal</h3>
            <button id="btnAgregarSucursal" class="btn btn-primary">
                <i class="fas fa-store-plus"></i> Agregar Sucursal
            </button>
        </div>

        <div class="dashboard-cards">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Total Sucursales</div>
                    <div class="card-icon" style="background-color: var(--primary);">
                        <i class="fas fa-store"></i>
                    </div>
                </div>
                <div class="card-value" id="totalSucursales">0</div>
                <div class="card-footer">
                    <i class="fas fa-info-circle"></i> Todas activas
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Sucursal con Más Ventas</div>
                    <div class="card-icon" style="background-color: var(--success);">
                        <i class="fas fa-trophy"></i>
                    </div>
                </div>
                <div class="card-value" id="sucursalMasVentas">-</div>
                <div class="card-footer positive" id="ventasMasSucursal">
                    <i class="fas fa-arrow-up"></i> $0 hoy
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Transferencias Pendientes</div>
                    <div class="card-icon" style="background-color: var(--warning);">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                </div>
                <div class="card-value" id="transferenciasPendientes">0</div>
                <div class="card-footer negative">
                    <i class="fas fa-exclamation-circle"></i> Requieren atención
                </div>
            </div>
        </div>

        <div class="modules-grid" id="modulesGrid">
            <!-- Aquí se van a cargar las sucursales desde JS -->
        </div>
    <div>
        <button id="btnNuevaTransferencia" class="btn btn-primary">
            <i class="fas fa-exchange-alt"></i> Nueva Transferencia
        </button>
    </div>


           <!-- Tabla de Transferencias -->
            <div class="table-container" style="margin-top: 30px;">
                <h3>Transferencias Entre Sucursales</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID Transferencia</th>
                            <th>Producto</th>
                            <th>Desde</th>
                            <th>Hacia</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="transferenciasTableBody">
                        <!-- Se carga desde JS -->
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>
</div>



<!-- Modal Agregar/Editar Sucursal -->
<div id="modalSucursal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3 id="modalTitle">Agregar Sucursal</h3>
        <form id="formSucursal">
            <input type="hidden" id="sucursalId">
            <label>Nombre de la Sucursal</label>
            <input type="text" id="nombreSucursal" required>

            <label>Dirección</label>
            <input type="text" id="direccionSucursal" required>

            <label>Teléfono</label>
            <input type="text" id="telefonoSucursal" required>

            <label>Online</label>
            <select id="onlineSucursal">
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>

            <label>Ventas Hoy</label>
            <input type="number" id="ventasHoySucursal" required>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

<!-- Modal Nueva Transferencia -->
<div id="modalNuevaTransferencia" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" id="cerrarNuevoTransferenciaModal">&times;</span>
        <h3>Nueva Transferencia</h3>
        <form id="formNuevaTransferencia">
            <label>Producto</label>
            <input type="text" id="producto" required>
            <label>Desde</label>
            <select id="desde" required></select>
            <label>Hacia</label>
            <select id="hacia" required></select>
            <label>Cantidad</label>
            <input type="number" id="cantidad" required>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
</div>

<!-- Modal Detalles de Transferencia -->
<div id="detallesTransferenciaModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" id="cerrarDetallesTransferenciaModal">&times;</span>
        <h3>Detalles de la Transferencia</h3>
            <p><strong>ID:</strong> <span id="det-id"></span></p>
            <p><strong>Producto:</strong> <span id="det-producto"></span></p>
            <p><strong>Desde:</strong> <span id="det-desde"></span></p>
            <p><strong>Hacia:</strong> <span id="det-hacia"></span></p>
            <p><strong>Cantidad:</strong> <span id="det-cantidad"></span></p>
            <p><strong>Fecha:</strong> <span id="det-fecha"></span></p>
            <p><strong>Estado:</strong> <span id="det-estado"></span></p>
    </div>
</div>


<script src="../assets/js/main.js"></script>
<script src="../assets/js/multisucursal.js"></script>
<script src="../assets/js/transferencias.js" defer></script>

</body>
</html>
