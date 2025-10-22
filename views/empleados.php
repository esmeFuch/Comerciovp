<?php
$page_title = "Gestión de Empleados";
$current_page = "empleados";
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestión de Empleados - CommercePro</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/empleados.css">
</head>
<body>
<div class="container">
    <?php include '../sidebar.php'; ?>
    <div class="main-content">
        <?php include '../header.php'; ?>
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h3>Empleados del Sistema</h3>
            <button class="btn btn-primary" id="btnAgregar"><i class="fas fa-user-plus"></i> Agregar Empleado</button>
        </div>
        <div class="table-container">
            <table class="data-table" id="tablaEmpleados">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Sucursal</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="empleadosBody">
                    <tr><td colspan="7" style="text-align:center;">Cargando empleados...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Crear/Editar Empleado -->
<div class="modal" id="modalEmpleado">
    <div class="modal-content">
        <div class="modal-header" id="modalTitleEmpleado">Agregar Empleado</div>
        <input type="hidden" id="empleadoId">
        <input type="text" id="nombre" placeholder="Nombre" required>
        <input type="email" id="email" placeholder="Email" required>
        <input type="text" id="rol" placeholder="Rol" required>
        <input type="text" id="sucursal" placeholder="Sucursal" required>
        <select id="estado">
            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>
        </select>
        <button id="guardarEmpleado" class="btn btn-primary">Guardar</button>
        <button id="cerrarModalEmpleado" class="btn btn-warning">Cancelar</button>
    </div>
</div>

<!-- Modal Confirmación Eliminar -->
<div class="modal" id="modalEliminar">
    <div class="modal-content">
        <div class="modal-header">Confirmar Eliminación</div>
        <p>¿Seguro que deseas eliminar este empleado?</p>
        <button id="confirmEliminar" class="btn btn-warning">Eliminar</button>
        <button id="cancelEliminar" class="btn btn-secondary">Cancelar</button>
    </div>
</div>

<script src="../assets/js/main.js"></script>
<script src="../assets/js/empleados.js"></script>
</body>
</html>
