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
                    <div class="card-value">$245,780</div>
                    <div class="card-footer positive">
                        <i class="fas fa-arrow-up"></i> 15% respecto al mes anterior
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Productos Más Vendidos</div>
                        <div class="card-icon" style="background-color: var(--success);">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="card-value">Aceite de Oliva</div>
                    <div class="card-footer">
                        342 unidades vendidas
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Clientes Nuevos</div>
                        <div class="card-icon" style="background-color: var(--warning);">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                    <div class="card-value">124</div>
                    <div class="card-footer positive">
                        <i class="fas fa-arrow-up"></i> 22% más que el mes anterior
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Ticket Promedio Mensual</div>
                        <div class="card-icon" style="background-color: var(--info);">
                            <i class="fas fa-receipt"></i>
                        </div>
                    </div>
                    <div class="card-value">$142.35</div>
                    <div class="card-footer positive">
                        <i class="fas fa-arrow-up"></i> 8% respecto al mes anterior
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
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Aceite de Oliva Extra Virgen 500ml</td>
                            <td>Aceites</td>
                            <td>342</td>
                            <td>$4,275.00</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Arroz Integral 1kg</td>
                            <td>Granos</td>
                            <td>298</td>
                            <td>$1,415.50</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Leche Deslactosada 1L</td>
                            <td>Lácteos</td>
                            <td>267</td>
                            <td>$854.40</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Jabón Líquido 750ml</td>
                            <td>Limpieza</td>
                            <td>245</td>
                            <td>$1,225.00</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Pasta Dental 100ml</td>
                            <td>Higiene</td>
                            <td>223</td>
                            <td>$780.50</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../assets/js/main.js"></script>
</body>
</html>