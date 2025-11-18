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

function showSection(section) {
    hideAllSections();
    document.getElementById(section + '-section').style.display = 'block';

    // Cargar las categorías cuando abrís inventario
    if (section === 'inventario') {
        cargarCategorias();
    }
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
