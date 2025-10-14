<?php
$page_title = "Facturación Electrónica";
$current_page = "facturacion";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación - CommercePro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <?php include '../sidebar.php'; ?>
        
        <div class="main-content">
            <?php include '../header.php'; ?>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3>Facturación Electrónica</h3>
                <button class="btn btn-primary">
                    <i class="fas fa-file-invoice"></i> Nueva Factura
                </button>
            </div>

            <div class="dashboard-cards">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Facturas del Mes</div>
                        <div class="card-icon" style="background-color: var(--primary);">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                    </div>
                    <div class="card-value">142</div>
                    <div class="card-footer positive">
                        <i class="fas fa-arrow-up"></i> 18% respecto al mes anterior
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Facturas Pendientes</div>
                        <div class="card-icon" style="background-color: var(--warning);">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="card-value">8</div>
                    <div class="card-footer negative">
                        <i class="fas fa-exclamation-circle"></i> Requieren atención
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Total Facturado</div>
                        <div class="card-icon" style="background-color: var(--success);">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="card-value">$45,780</div>
                    <div class="card-footer positive">
                        <i class="fas fa-arrow-up"></i> 22% respecto al mes anterior
                    </div>
                </div>
            </div>
            
            <div class="table-container">
                <h3>Historial de Facturas Recientes</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>N° Factura</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>F-2023-00542</td>
                            <td>María González</td>
                            <td>15/11/2023</td>
                            <td>$245.50</td>
                            <td><span class="positive">Pagada</span></td>
                            <td>
                                <button class="btn" style="padding: 5px 10px; background: var(--info); color: white;">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn" style="padding: 5px 10px; background: var(--primary); color: white;">
                                    <i class="fas fa-download"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>F-2023-00541</td>
                            <td>Carlos Rodríguez</td>
                            <td>15/11/2023</td>
                            <td>$189.75</td>
                            <td><span class="positive">Pagada</span></td>
                            <td>
                                <button class="btn" style="padding: 5px 10px; background: var(--info); color: white;">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn" style="padding: 5px 10px; background: var(--primary); color: white;">
                                    <i class="fas fa-download"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>F-2023-00540</td>
                            <td>Empresa XYZ S.A.</td>
                            <td>14/11/2023</td>
                            <td>$1,245.00</td>
                            <td><span class="negative">Pendiente</span></td>
                            <td>
                                <button class="btn" style="padding: 5px 10px; background: var(--info); color: white;">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn" style="padding: 5px 10px; background: var(--warning); color: white;">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>F-2023-00539</td>
                            <td>Laura Martínez</td>
                            <td>14/11/2023</td>
                            <td>$89.99</td>
                            <td><span class="positive">Pagada</span></td>
                            <td>
                                <button class="btn" style="padding: 5px 10px; background: var(--info); color: white;">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn" style="padding: 5px 10px; background: var(--primary); color: white;">
                                    <i class="fas fa-download"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-container">
                <h3 style="margin-bottom: 20px;">Configuración de Facturación</h3>
                <form>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label class="form-label" for="serie-factura">Serie de Factura</label>
                            <input type="text" id="serie-factura" class="form-control" value="F-2023" placeholder="Serie de factura">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="proximo-numero">Próximo Número</label>
                            <input type="number" id="proximo-numero" class="form-control" value="543" placeholder="Próximo número">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="resolucion-sat">Resolución SAT</label>
                        <input type="text" id="resolucion-sat" class="form-control" placeholder="Número de resolución SAT">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="firma-electronica">Firma Electrónica</label>
                        <input type="file" id="firma-electronica" class="form-control">
                        <small style="color: var(--gray);">Subir archivo .p12 de firma electrónica</small>
                    </div>
                    
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Configuración
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/main.js"></script>
</body>
</html>