<?php
require_once 'config.php';
require_once 'urls.php';
?>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        <i class="fas fa-cash-register"></i>
        <h1>CommercePro</h1>
    </div>
    <div class="menu-items">

        <a href="<?php echo $url_dashboard; ?>" class="menu-item <?php echo $current_page == 'dashboard' ? 'active' : ''; ?>">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
        <a href="<?php echo $url_ventas; ?>" class="menu-item <?php echo $current_page == 'ventas' ? 'active' : ''; ?>">
            <i class="fas fa-shopping-cart"></i>
            <span>Registro de Ventas</span>
        </a> 

        <a href="<?php echo $url_escaner; ?>" class="menu-item <?php echo $current_page == 'escaner' ? 'active' : ''; ?>">
            <i class="fas fa-barcode"></i>
            <span>Escáner</span>
        </a>

        <a href="<?php echo $url_facturacion; ?>" class="menu-item <?php echo $current_page == 'facturacion' ? 'active' : ''; ?>">
            <i class="fas fa-receipt"></i>
            <span>Facturación</span>
        </a>

        <a href="<?php echo $url_productos; ?>" class="menu-item <?php echo $current_page == 'productos' ? 'active' : ''; ?>">
            <i class="fas fa-boxes"></i>
            <span>Gestión de Productos</span>
        </a>
        <a href="<?php echo $url_estadisticas; ?>" class="menu-item <?php echo $current_page == 'estadisticas' ? 'active' : ''; ?>">
            <i class="fas fa-chart-bar"></i>
            <span>Estadísticas</span>
        </a>
        <a href="<?php echo $url_empleados; ?>" class="menu-item <?php echo $current_page == 'empleados' ? 'active' : ''; ?>">
            <i class="fas fa-users"></i>
            <span>Gestión de Empleados</span>
        </a>
        <a href="<?php echo $url_multisucursal; ?>" class="menu-item <?php echo $current_page == 'multisucursal' ? 'active' : ''; ?>">
            <i class="fas fa-store"></i>
            <span>Multisucursal</span>
        </a>
        <a href="<?php echo $url_configuracion; ?>" class="menu-item <?php echo $current_page == 'configuracion' ? 'active' : '' ; ?>">
            <i class="fas fa-cog"></i>
            <span>Configuración</span>
        </a>
    </div>
</div>