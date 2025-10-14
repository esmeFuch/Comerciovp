<?php
// Definir la página actual si no está definida
if (!isset($current_page)) {
    $current_page = "dashboard";
}
?>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        <i class="fas fa-cash-register"></i>
        <h1>CommercePro</h1>
    </div>
    <div class="menu-items">
        <a href="index.php" class="menu-item <?php echo $current_page == 'dashboard' ? 'active' : ''; ?>">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
        <a href="views/ventas.php" class="menu-item <?php echo $current_page == 'ventas' ? 'active' : ''; ?>">
            <i class="fas fa-shopping-cart"></i>
            <span>Registro de Ventas</span>
        </a>
        <a href="views/escaner.php" class="menu-item <?php echo $current_page == 'escaner' ? 'active' : ''; ?>">
            <i class="fas fa-barcode"></i>
            <span>Escáner</span>
        </a>
        <a href="views/facturacion.php" class="menu-item <?php echo $current_page == 'facturacion' ? 'active' : ''; ?>">
            <i class="fas fa-receipt"></i>
            <span>Facturación</span>
        </a>
        <a href="views/productos.php" class="menu-item <?php echo $current_page == 'productos' ? 'active' : ''; ?>">
            <i class="fas fa-boxes"></i>
            <span>Gestión de Productos</span>
        </a>
        <a href="views/estadisticas.php" class="menu-item <?php echo $current_page == 'estadisticas' ? 'active' : ''; ?>">
            <i class="fas fa-chart-bar"></i>
            <span>Estadísticas</span>
        </a>
        <a href="views/empleados.php" class="menu-item <?php echo $current_page == 'empleados' ? 'active' : ''; ?>">
            <i class="fas fa-users"></i>
            <span>Gestión de Empleados</span>
        </a>
        <a href="views/multisucursal.php" class="menu-item <?php echo $current_page == 'multisucursal' ? 'active' : ''; ?>">
            <i class="fas fa-store"></i>
            <span>Multisucursal</span>
        </a>
        <a href="views/configuracion.php" class="menu-item <?php echo $current_page == 'configuracion' ? 'active' : ''; ?>">
            <i class="fas fa-cog"></i>
            <span>Configuración</span>
        </a>
    </div>
</div>