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
</head>
<body>
    <div class="container">
        <?php include '../sidebar.php'; ?>
        
        <div class="main-content">
            <?php include '../header.php'; ?>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3>Gestión Multisucursal</h3>
                <button class="btn btn-primary">
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
                    <div class="card-value">5</div>
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
                    <div class="card-value">Sucursal Centro</div>
                    <div class="card-footer positive">
                        <i class="fas fa-arrow-up"></i> $12,458 hoy
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Transferencias Pendientes</div>
                        <div class="card-icon" style="background-color: var(--warning);">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                    </div>
                    <div class="card-value">3</div>
                    <div class="card-footer negative">
                        <i class="fas fa-exclamation-circle"></i> Requieren atención
                    </div>
                </div>
            </div>
            
            <div class="modules-grid">
                <div class="module-card">
                    <div class="module-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="module-title">Sucursal Centro</div>
                    <div class="module-description">
                        Av. Principal #123, Zona Centro. Tel: 555-0101. Ventas hoy: $12,458
                    </div>
                    <div style="margin-top: 15px;">
                        <span class="positive" style="font-weight: bold;">● En línea</span>
                        <button class="btn" style="padding: 5px 10px; background: var(--info); color: white; float: right;">
                            <i class="fas fa-cog"></i>
                        </button>
                    </div>
                </div>
                
                <div class="module-card">
                    <div class="module-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="module-title">Sucursal Norte</div>
                    <div class="module-description">
                        Calle Norte #456, Sector Norte. Tel: 555-0102. Ventas hoy: $8,742
                    </div>
                    <div style="margin-top: 15px;">
                        <span class="positive" style="font-weight: bold;">● En línea</span>
                        <button class="btn" style="padding: 5px 10px; background: var(--info); color: white; float: right;">
                            <i class="fas fa-cog"></i>
                        </button>
                    </div>
                </div>
                
                <div class="module-card">
                    <div class="module-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="module-title">Sucursal Sur</div>
                    <div class="module-description">
                        Av. Sur #789, Col. Sur. Tel: 555-0103. Ventas hoy: $9,125
                    </div>
                    <div style="margin-top: 15px;">
                        <span class="positive" style="font-weight: bold;">● En línea</span>
                        <button class="btn" style="padding: 5px 10px; background: var(--info); color: white; float: right;">
                            <i class="fas fa-cog"></i>
                        </button>
                    </div>
                </div>
                
                <div class="module-card">
                    <div class="module-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="module-title">Sucursal Este</div>
                    <div class="module-description">
                        Calle Este #321, Zona Este. Tel: 555-0104. Ventas hoy: $7,893
                    </div>
                    <div style="margin-top: 15px;">
                        <span class="positive" style="font-weight: bold;">● En línea</span>
                        <button class="btn" style="padding: 5px 10px; background: var(--info); color: white; float: right;">
                            <i class="fas fa-cog"></i>
                        </button>
                    </div>
                </div>
                
                <div class="module-card">
                    <div class="module-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="module-title">Sucursal Oeste</div>
                    <div class="module-description">
                        Av. Oeste #654, Sector Oeste. Tel: 555-0105. Ventas hoy: $6,542
                    </div>
                    <div style="margin-top: 15px;">
                        <span class="positive" style="font-weight: bold;">● En línea</span>
                        <button class="btn" style="padding: 5px 10px; background: var(--info); color: white; float: right;">
                            <i class="fas fa-cog"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="table-container">
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
                    <tbody>
                        <tr>
                            <td>TRF-2023-001</td>
                            <td>Aceite de Oliva Extra Virgen 500ml</td>
                            <td>Sucursal Centro</td>
                            <td>Sucursal Norte</td>
                            <td>24 unidades</td>
                            <td>15/11/2023</td>
                            <td><span class="positive">Completada</span></td>
                            <td>
                                <button class="btn" style="padding: 5px 10px; background: var(--info); color: white;">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>TRF-2023-002</td>
                            <td>Arroz Integral 1kg</td>
                            <td>Sucursal Norte</td>
                            <td>Sucursal Sur</td>
                            <td>50 unidades</td>
                            <td>14/11/2023</td>
                            <td><span class="negative">Pendiente</span></td>
                            <td>
                                <button class="btn" style="padding: 5px 10px; background: var(--success); color: white;">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn" style="padding: 5px 10px; background: var(--warning); color: white;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>TRF-2023-003</td>
                            <td>Leche Deslactosada 1L</td>
                            <td>Sucursal Sur</td>
                            <td>Sucursal Este</td>
                            <td>30 unidades</td>
                            <td>14/11/2023</td>
                            <td><span class="negative">Pendiente</span></td>
                            <td>
                                <button class="btn" style="padding: 5px 10px; background: var(--success); color: white;">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn" style="padding: 5px 10px; background: var(--warning); color: white;">
                                    <i class="fas fa-times"></i>
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