document.addEventListener('DOMContentLoaded', () => {
    cargarTransferencias();
});

async function cargarSucursalesParaTransferencia() {
    try {
        const res = await fetch('../backend/data/sucursales.json');
        const sucursales = await res.json();
        
        // Solo actualizar los selects necesarios para transferencias
        const desdeSelect = document.getElementById('desde');
        const haciaSelect = document.getElementById('hacia');
        
        [desdeSelect, haciaSelect].forEach(select => {
            select.innerHTML = '';
            sucursales.forEach(s => {
                const option = document.createElement('option');
                option.value = s.nombre;
                option.textContent = s.nombre;
                select.appendChild(option);
            });
        });
    } catch (err) {
        console.error('Error al cargar sucursales:', err);
    }
}

// Cargar transferencias desde JSON
async function cargarTransferencias() {
    const tbody = document.getElementById('transferenciasTableBody');
    tbody.innerHTML = '';
    try {
        const res = await fetch('../backend/controllers/transferencias/getTransferencias.php');
        const data = await res.json();
        let pendientes = 0;
        data.forEach(t => {
            const estado = t.estado ? t.estado.toLowerCase() : 'pendiente';
            if (estado === 'pendiente') pendientes++;
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${t.id}</td>
                <td>${t.producto}</td>
                <td>${t.desde}</td>
                <td>${t.hacia}</td>
                <td>${t.cantidad}</td>
                <td>${t.fecha}</td>
                <td><span class="${estado}">${t.estado || 'Pendiente'}</span></td>
                <td>
                    ${estado === 'pendiente' ? `
                        <button class="btn" style="padding:5px 10px; background:var(--success); color:white;" onclick="aceptarTransferencia('${t.id}')">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn" style="padding:5px 10px; background:var(--warning); color:white;" onclick="rechazarTransferencia('${t.id}')">
                            <i class="fas fa-times"></i>
                        </button>
                    ` : `
                        <button class="btn" style="padding:5px 10px; background:var(--info); color:white;" onclick="verDetalles('${t.id}')">
                            <i class="fas fa-eye"></i>
                        </button>
                    `}
                </td>
            `;
            tbody.appendChild(tr);
        });
        document.getElementById('transferenciasPendientes').textContent = pendientes;
    } catch (err) {
        console.error('Error al cargar transferencias:', err);
        tbody.innerHTML = `<tr><td colspan="8">Error cargando transferencias</td></tr>`;
    }
}

// Función para ver detalles
async function verDetalles(id) {
    const modal = document.getElementById('detallesTransferenciaModal');
    try {
        const res = await fetch('../backend/controllers/transferencias/getTransferencias.php');
        const data = await res.json();
        const t = data.find(item => item.id === id);
        document.getElementById('det-id').textContent = t.id;
        document.getElementById('det-producto').textContent = t.producto;
        document.getElementById('det-desde').textContent = t.desde;
        document.getElementById('det-hacia').textContent = t.hacia;
        document.getElementById('det-cantidad').textContent = t.cantidad;
        document.getElementById('det-fecha').textContent = t.fecha;
        document.getElementById('det-estado').textContent = t.estado || 'Pendiente';
        modal.style.display = 'flex';
    } catch (err) {
        console.error('Error al cargar detalles:', err);
    }
}

// Funciones aceptar/rechazar
async function actualizarTransferencia(id, estado) {
    try {
        await fetch('../backend/controllers/transferencias/updateTransferencia.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, estado })
        });
        cargarTransferencias();
    } catch (err) {
        console.error(err);
    }
}

function aceptarTransferencia(id) {
    actualizarTransferencia(id, 'Completada');
}

function rechazarTransferencia(id) {
    actualizarTransferencia(id, 'Rechazada');
}

// Manejo de formularios y modales
const modalNuevo = document.getElementById('modalNuevaTransferencia');
const btnAbrirNuevo = document.getElementById('btnNuevaTransferencia');
const btnCerrarNuevo = document.getElementById('cerrarNuevoTransferenciaModal');
const formNueva = document.getElementById('formNuevaTransferencia');
const modalDetalles = document.getElementById('detallesTransferenciaModal');
const btnCerrarDetalles = document.getElementById('cerrarDetallesTransferenciaModal');

btnAbrirNuevo.onclick = () => {
    modalNuevo.style.display = 'flex';
    cargarSucursalesParaTransferencia();
};

btnCerrarNuevo.onclick = () => modalNuevo.style.display = 'none';
btnCerrarDetalles.onclick = () => modalDetalles.style.display = 'none';

window.onclick = (e) => {
    if (e.target == modalNuevo) modalNuevo.style.display = 'none';
    if (e.target == modalDetalles) modalDetalles.style.display = 'none';
};

formNueva.addEventListener('submit', async (e) => {
    e.preventDefault();
    const producto = document.getElementById('producto').value;
    const desde = document.getElementById('desde').value;
    const hacia = document.getElementById('hacia').value;
    const cantidad = document.getElementById('cantidad').value;
    try {
        await fetch('../backend/controllers/transferencias/postTransferencia.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ producto, desde, hacia, cantidad })
        });
        modalNuevo.style.display = 'none';
        formNueva.reset();
        cargarTransferencias();
    } catch (err) {
        console.error('Error al guardar transferencia:', err);
    }
});