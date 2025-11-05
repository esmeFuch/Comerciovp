<?php
$page_title = "Estadísticas y Reportes";
$current_page = "estadisticas";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas - CommercePro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* Colores dinámicos para los porcentajes */
        .positive { color: green; }
        .negative { color: red; }
    </style>
</head>
<body>
<div class="container">
    <?php include '../sidebar.php'; ?>
    <div class="main-content">
        <?php include '../header.php'; ?>
        <div class="dashboard-cards">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Ventas del Mes</div>
                    <div class="card-icon" style="background-color: var(--primary);">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="card-value" id="ventas-mes">$0.00</div>
                <div class="card-footer" id="ventas-mes-footer">
                    <i class="fas fa-arrow-up"></i> 0% respecto al mes anterior
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Producto Más Vendido</div>
                    <div class="card-icon" style="background-color: var(--success);">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="card-value" id="top-producto-nombre">-</div>
                <div class="card-footer" id="top-producto-unidades">
                    0 unidades vendidas
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Clientes Nuevos</div>
                    <div class="card-icon" style="background-color: var(--warning);">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
                <div class="card-value" id="clientes-nuevos">0</div>
                <div class="card-footer" id="clientes-nuevos-footer">
                    <i class="fas fa-arrow-up"></i> 0% más que el mes anterior
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Ticket Promedio Mensual</div>
                    <div class="card-icon" style="background-color: var(--info);">
                        <i class="fas fa-receipt"></i>
                    </div>
                </div>
                <div class="card-value" id="ticket-promedio">$0.00</div>
                <div class="card-footer" id="ticket-promedio-footer">
                    <i class="fas fa-arrow-up"></i> 0% respecto al mes anterior
                </div>
            </div>
        </div>

        <div class="table-container">
            <h3>Top 10 Productos Más Vendidos</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Posición</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Unidades Vendidas</th>
                        <th>Ingresos</th>
                    </tr>
                </thead>
                <tbody id="top-productos-body">
                    <!-- Se llena dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../assets/js/estadisticas.js"></script>
<script>
    // Esto asegura que los porcentajes tengan color dinámico según positivo o negativo
    function actualizarColorPorcentaje(id, porcentaje) {
        const elem = document.getElementById(id);
        if (!elem) return;
        elem.classList.remove("positive", "negative");
        elem.classList.add(porcentaje >= 0 ? "positive" : "negative");
    }
</script>
</body>
</html>
