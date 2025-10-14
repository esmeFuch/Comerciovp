<?php
$page_title = "Escáner de Productos";
$current_page = "escaner";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escáner - CommercePro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <?php include '../sidebar.php'; ?>
        
        <div class="main-content">
            <?php include '../header.php'; ?>
            
            <div class="form-container">
                <h3 style="margin-bottom: 20px;">Escáner de Código de Barras</h3>
                <div style="text-align: center; margin-bottom: 30px;">
                    <div style="width: 300px; height: 200px; background: var(--light-gray); border-radius: var(--border-radius); margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-barcode" style="font-size: 80px; color: var(--gray);"></i>
                    </div>
                    <p>Posiciona el código de barras frente a la cámara para escanear automáticamente</p>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="codigo-manual">O ingresa el código manualmente</label>
                    <input type="text" id="codigo-manual" class="form-control" placeholder="Ingresar código de barras manualmente">
                </div>
                
                <button class="btn btn-primary">
                    <i class="fas fa-search"></i> Buscar Producto
                </button>
            </div>
        </div>
    </div>

    <script src="../assets/js/main.js"></script>
</body>
</html>