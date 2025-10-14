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
</head>
<body>
    <div class="container">
        <?php include '../sidebar.php'; ?>
        
        <div class="main-content">
            <?php include '../header.php'; ?>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3>Empleados del Sistema</h3>
                <button class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Agregar Empleado
                </button>
            </div>
            
            <div class="table-container">
                <table class="data-table">
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
                    <tbody>
                        <tr>
                            <td>EMP001</td>
                            <td>Ana Martínez</td>
                            <td>ana.martinez@commercepro.com</td>
                            <td>Administradora</td>
                            <td>Sucursal Centro</td>
                            <td><span class="positive">Activo</span></td>
                            <td>
                                <button class="btn" style="padding: 5px 10px; background: var(--info); color: white;">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn" style="padding: 5px 10px; background: var(--warning); color: white;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>EMP002</td>
                            <td>Carlos Rodríguez</td>
                            <td>carlos.rodriguez@commercepro.com</td>
                            <td>Cajero</td>
                            <td>Sucursal Norte</td>
                            <td><span class="positive">Activo</span></td>
                            <td>
                                <button class="btn" style="padding: 5px 10px; background: var(--info); color: white;">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn" style="padding: 5px 10px; background: var(--warning); color: white;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>EMP003</td>
                            <td>Laura Sánchez</td>
                            <td>laura.sanchez@commercepro.com</td>
                            <td>Supervisora</td>
                            <td>Sucursal Sur</td>
                            <td><span class="positive">Activo</span></td>
                            <td>
                                <button class="btn" style="padding: 5px 10px; background: var(--info); color: white;">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn" style="padding: 5px 10px; background: var(--warning); color: white;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../assets/js/main.js"></script>
</body>
</html>