<?php
$page_title = "Dashboard Principal";
$current_page = "dashboard";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CommercePro - Sistema de Gestión Comercial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        
        <div class="main-content">
            <?php include 'header.php'; ?>
            
            <!-- Dashboard Cards -->
            <div class="dashboard-cards">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Ventas Hoy</div>
                        <div class="card-icon" style="background-color: var(--primary);">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="card-value">$12,458</div>
                    <div class="card-footer positive">
                        <i class="fas fa-arrow-up"></i> 12% respecto a ayer
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Productos Vendidos</div>
                        <div class="card-icon" style="background-color: var(--success);">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                    <div class="card-value">342</div>
                    <div class="card-footer positive">
                        <i class="fas fa-arrow-up"></i> 8% respecto a ayer
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Clientes Atendidos</div>
                        <div class="card-icon" style="background-color: var(--warning);">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="card-value">89</div>
                    <div class="card-footer negative">
                        <i class="fas fa-arrow-down"></i> 3% respecto a ayer
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Ticket Promedio</div>
                        <div class="card-icon" style="background-color: var(--info);">
                            <i class="fas fa-receipt"></i>
                        </div>
                    </div>
                    <div class="card-value">$139.98</div>
                    <div class="card-footer positive">
                        <i class="fas fa-arrow-up"></i> 5% respecto a ayer
                    </div>
                </div>
            </div>

            <!-- Modules Grid -->
            <h3 style="margin-bottom: 15px;">Módulos Principales</h3>
            <div class="modules-grid">
                <div class="module-card" onclick="window.location.href='views/ventas.php'">
                    <div class="module-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="module-title">Registro de Ventas</div>
                    <div class="module-description">
                        Registro rápido de ventas con escáner de código de barras, múltiples métodos de pago y generación de tickets o facturas.
                    </div>
                </div>
                
                <div class="module-card" onclick="window.location.href='views/escaner.php'">
                    <div class="module-icon">
                        <i class="fas fa-barcode"></i>
                    </div>
                    <div class="module-title">Escáner de Productos</div>
                    <div class="module-description">
                        Escaneo rápido de códigos de barras para búsqueda instantánea de productos y registro automático en ventas.
                    </div>
                </div>
                
                <div class="module-card" onclick="window.location.href='views/facturacion.php'">
                    <div class="module-icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div class="module-title">Facturación Electrónica</div>
                    <div class="module-description">
                        Generación de facturas electrónicas con integración ARCA y envío automático a clientes.
                    </div>
                </div>
                
                <div class="module-card" onclick="window.location.href='views/productos.php'">
                    <div class="module-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="module-title">Gestión de Inventario</div>
                    <div class="module-description">
                        Control completo de stock, alertas de productos bajos, gestión de proveedores y movimientos de inventario.
                    </div>
                </div>
                
                <div class="module-card" onclick="window.location.href='views/estadisticas.php'">
                    <div class="module-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="module-title">Estadísticas en Tiempo Real</div>
                    <div class="module-description">
                        Dashboard con métricas en tiempo real, análisis de ventas, productos más vendidos y tendencias.
                    </div>
                </div>
                
                <div class="module-card" onclick="window.location.href='views/empleados.php'">
                    <div class="module-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="module-title">Gestión de Empleados</div>
                    <div class="module-description">
                        Administración de usuarios, roles, permisos, turnos y control de acceso al sistema.
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <h3 style="margin-bottom: 15px; margin-top: 30px;">Actividad Reciente</h3>
            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Venta registrada #00125</div>
                        <div class="activity-description">Carlos Rodríguez - $245.50</div>
                        <div class="activity-time">Hace 5 minutos</div>
                    </div>
                </div>
                
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Stock bajo en "Aceite de Oliva"</div>
                        <div class="activity-description">Quedan 8 unidades en inventario</div>
                        <div class="activity-time">Hace 12 minutos</div>
                    </div>
                </div>
                
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Factura electrónica generada</div>
                        <div class="activity-description">Factura #F-2023-00542 enviada a María González</div>
                        <div class="activity-time">Hace 25 minutos</div>
                    </div>
                </div>
                
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Turno iniciado</div>
                        <div class="activity-description">Laura Sánchez inició su turno en Sucursal Centro</div>
                        <div class="activity-time">Hace 1 hora</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
</body>
</html>