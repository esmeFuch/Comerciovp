<?php
$page_title = "Configuración del Sistema";
$current_page = "configuracion";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración - CommercePro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <?php include '../sidebar.php'; ?>
        
        <div class="main-content">
            <?php include '../header.php'; ?>
            
            <h3 style="margin-bottom: 20px;">Configuración del Sistema</h3>
            
            <div class="modules-grid">
                <div class="module-card" onclick="showSection('empresa')">
                    <div class="module-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="module-title">Datos de la Empresa</div>
                    <div class="module-description">
                        Configurar información fiscal, dirección, contactos y datos legales de la empresa.
                    </div>
                </div>
                
                <div class="module-card" onclick="showSection('facturacion')">
                    <div class="module-icon">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <div class="module-title">Configuración de Facturación</div>
                    <div class="module-description">
                        Parámetros de facturación electrónica, series, resolución SAT y configuración fiscal.
                    </div>
                </div>
                
                <div class="module-card" onclick="showSection('inventario')">
                    <div class="module-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="module-title">Configuración de Inventario</div>
                    <div class="module-description">
                        Alertas de stock, categorías, proveedores y parámetros del sistema de inventario.
                    </div>
                </div>
                
                <div class="module-card" onclick="showSection('seguridad')">
                    <div class="module-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="module-title">Seguridad y Accesos</div>
                    <div class="module-description">
                        Configuración de roles, permisos, contraseñas y políticas de seguridad del sistema.
                    </div>
                </div>
                
                <div class="module-card" onclick="showSection('backup')">
                    <div class="module-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <div class="module-title">Backup y Respaldos</div>
                    <div class="module-description">
                        Configuración de respaldos automáticos, restauración y gestión de copias de seguridad.
                    </div>
                </div>
                
                <div class="module-card" onclick="showSection('notificaciones')">
                    <div class="module-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="module-title">Notificaciones</div>
                    <div class="module-description">
                        Configurar alertas, notificaciones por email y preferencias de comunicación.
                    </div>
                </div>
            </div>

            <!-- Sección de Configuración de Empresa -->
            <div id="empresa-section" class="form-container" style="display: none;">
                <h3 style="margin-bottom: 20px;">Datos de la Empresa</h3>
                <form>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label class="form-label" for="nombre-empresa">Nombre de la Empresa</label>
                            <input type="text" id="nombre-empresa" class="form-control" value="Mi Comercio S.A." placeholder="Nombre legal de la empresa">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="nit">NIT/RUC</label>
                            <input type="text" id="nit" class="form-control" value="123456789" placeholder="Número de identificación tributaria">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="direccion">Dirección</label>
                        <input type="text" id="direccion" class="form-control" value="Av. Principal #123, Zona 1" placeholder="Dirección completa">
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label class="form-label" for="telefono">Teléfono</label>
                            <input type="text" id="telefono" class="form-control" value="555-1234" placeholder="Teléfono de contacto">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" class="form-control" value="info@micomercio.com" placeholder="Email de contacto">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="giro">Giro del Negocio</label>
                        <input type="text" id="giro" class="form-control" value="Venta de productos de abarrotes" placeholder="Descripción del giro del negocio">
                    </div>
                    
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                    <button type="button" class="btn" onclick="hideAllSections()" style="background: var(--gray); color: white;">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                </form>
            </div>

            <!-- Sección de Configuración de Inventario -->
            <div id="inventario-section" class="form-container" style="display: none;">
                <h3 style="margin-bottom: 20px;">Configuración de Inventario</h3>
                <form>
                    <div class="form-group">
                        <label class="form-label" for="stock-minimo">Stock Mínimo Global</label>
                        <input type="number" id="stock-minimo" class="form-control" value="10" placeholder="Stock mínimo para alertas">
                        <small style="color: var(--gray);">Nivel mínimo de stock para generar alertas automáticas</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="categorias">Categorías de Productos</label>
                        <textarea id="categorias" class="form-control" rows="4" placeholder="Ingrese cada categoría en una línea"></textarea>
                        <small style="color: var(--gray);">Una categoría por línea</small>
                    </div>
                    <button type="button" class="btn btn-success" id="guardar-categorias">
                        <i class="fas fa-save"></i> Guardar Categorías
                    </button>

                    
                    <div class="form-group">
                        <label class="form-label">
                            <input type="checkbox" id="control-lotes" checked> Control de Lotes y Fechas de Vencimiento
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <input type="checkbox" id="inventario-automatico" checked> Actualización Automática de Inventario
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Configuración
                    </button>
                    <button type="button" class="btn" onclick="hideAllSections()" style="background: var(--gray); color: white;">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                </form>
            </div>

            <!-- Sección de Seguridad -->
            <div id="seguridad-section" class="form-container" style="display: none;">
                <h3 style="margin-bottom: 20px;">Configuración de Seguridad</h3>
                <form>
                    <div class="form-group">
                        <label class="form-label" for="tiempo-sesion">Tiempo de Sesión (minutos)</label>
                        <input type="number" id="tiempo-sesion" class="form-control" value="60" placeholder="Tiempo de inactividad antes de cerrar sesión">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="intentos-contraseña">Intentos de Contraseña</label>
                        <input type="number" id="intentos-contraseña" class="form-control" value="3" placeholder="Intentos fallidos antes de bloquear">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <input type="checkbox" id="requerir-contraseña-fuerte" checked> Requerir Contraseña Fuerte
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <input type="checkbox" id="autenticacion-dos-factores"> Autenticación de Dos Factores
                        </label>
                    </div>
                    
                    <h4 style="margin: 20px 0 10px;">Cambiar Contraseña</h4>
                    <div class="form-group">
                        <label class="form-label" for="contraseña-actual">Contraseña Actual</label>
                        <input type="password" id="contraseña-actual" class="form-control" placeholder="Ingrese su contraseña actual">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="nueva-contraseña">Nueva Contraseña</label>
                        <input type="password" id="nueva-contraseña" class="form-control" placeholder="Ingrese nueva contraseña">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="confirmar-contraseña">Confirmar Contraseña</label>
                        <input type="password" id="confirmar-contraseña" class="form-control" placeholder="Confirme la nueva contraseña">
                    </div>
                    
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                    <button type="button" class="btn" onclick="hideAllSections()" style="background: var(--gray); color: white;">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/main.js"></script>
    <script>

        // Cargar categorías al abrir la sección
async function cargarCategorias() {
    try {
        const res = await fetch('../backend/controllers/configuracion/getCategorias.php');
        const categorias = await res.json();
        document.getElementById('categorias').value = categorias.join('\n');
    } catch (e) { console.error(e); }
}

// Guardar categorías
document.getElementById('guardar-categorias').addEventListener('click', async () => {
    const text = document.getElementById('categorias').value.trim();
    const categorias = text.split('\n').map(c => c.trim()).filter(c => c !== '');
    try {
        const res = await fetch('../backend/controllers/configuracion/saveCategorias.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ categorias })
        });
        const result = await res.json();
        if (result.success) alert('Categorías guardadas correctamente');
        else alert(result.error || 'Error al guardar categorías');
    } catch (e) { console.error(e); alert('Error al guardar categorías'); }
});

// Llamar al cargar la sección de inventario
if (document.getElementById('inventario-section').style.display !== 'none') {
    cargarCategorias();
}

        function showSection(section) {
            // Ocultar todas las secciones primero
            hideAllSections();
            
            // Mostrar la sección seleccionada
            document.getElementById(section + '-section').style.display = 'block';
        }
        
        function hideAllSections() {
            const sections = ['empresa', 'facturacion', 'inventario', 'seguridad', 'backup', 'notificaciones'];
            sections.forEach(section => {
                const element = document.getElementById(section + '-section');
                if (element) {
                    element.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>