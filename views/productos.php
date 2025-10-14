<?php
$page_title = "Gestión de Productos";
$current_page = "productos";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - CommercePro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <?php include '../sidebar.php'; ?>
        
        <div class="main-content">
            <?php include '../header.php'; ?>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3>Inventario de Productos</h3>
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Agregar Producto
                </button>
            </div>
            
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PRD001</td>
                            <td>Aceite de Oliva Extra Virgen 500ml</td>
                            <td>Aceites</td>
                            <td>$12.50</td>
                            <td>24</td>
                            <td><span class="positive">Disponible</span></td>
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
                            <td>PRD002</td>
                            <td>Arroz Integral 1kg</td>
                            <td>Granos</td>
                            <td>$4.75</td>
                            <td>56</td>
                            <td><span class="positive">Disponible</span></td>
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
                            <td>PRD003</td>
                            <td>Leche Deslactosada 1L</td>
                            <td>Lácteos</td>
                            <td>$3.20</td>
                            <td>8</td>
                            <td><span class="negative">Stock Bajo</span></td>
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