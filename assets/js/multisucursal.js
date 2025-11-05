const modal = document.getElementById("modalSucursal");
const btnAgregar = document.getElementById("btnAgregarSucursal");
const spanClose = modal.querySelector(".close");
const form = document.getElementById("formSucursal");

btnAgregar.onclick = () => {
    modal.style.display = "flex";
    document.getElementById("modalTitle").textContent = "Agregar Sucursal";
    form.reset();
    document.getElementById("sucursalId").value = "";
};

spanClose.onclick = () => modal.style.display = "none";
window.onclick = e => { if(e.target === modal) modal.style.display="none"; };

async function cargarSucursales() {
    const res = await fetch("../backend/controllers/multisucursal/getSucursales.php");
    const sucursales = await res.json();

    const grid = document.getElementById("modulesGrid");
    grid.innerHTML = "";

    let totalSucursales = sucursales.length;
    let sucursalMasVentas = "-";
    let ventasMax = 0;
    let transferenciasPendientes = 0;

    sucursales.forEach(s => {
        if(s.ventasHoy > ventasMax){ ventasMax=s.ventasHoy; sucursalMasVentas=s.nombre; }
        if(s.estado === "pendiente") transferenciasPendientes++;
        
        grid.innerHTML += `
            <div class="module-card">
                <div class="module-icon"><i class="fas fa-store"></i></div>
                <div class="module-title">${s.nombre}</div>
                <div class="module-description">
                    ${s.direccion}. Tel: ${s.telefono}. Ventas hoy: $${s.ventasHoy}
                </div>
                <div style="margin-top:15px; display: flex; justify-content: space-between; align-items: center;">
                    <span class="${s.online?"positive":"negative"}" style="font-weight:bold; margin-right: 80px;">● ${s.online?"Activa":"Inactiva"}</span>
                    </div>
                     <button class="btn" style="padding:5px 10px; background:var(--info); color:white;" onclick="editarSucursal('${s.id}')"><i class="fas fa-edit"></i></button>
                    <button class="btn" style="padding:5px 10px; background:var(--warning); color:white;" onclick="eliminarSucursal('${s.id}')"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        `;
    });

    document.getElementById("totalSucursales").textContent = totalSucursales;
    document.getElementById("sucursalMasVentas").textContent = sucursalMasVentas;
    document.getElementById("ventasMasSucursal").innerHTML = `<i class="fas fa-arrow-up"></i> $${ventasMax} hoy`;
    document.getElementById("transferenciasPendientes").textContent = transferenciasPendientes;
}

async function editarSucursal(id){
    const res = await fetch("../backend/controllers/multisucursal/getSucursales.php");
    const sucursales = await res.json();
    const s = sucursales.find(s=>s.id===id);
    if(!s) return;

    modal.style.display="flex";
    document.getElementById("modalTitle").textContent="Editar Sucursal";
    document.getElementById("sucursalId").value = s.id;
    document.getElementById("nombreSucursal").value = s.nombre;
    document.getElementById("direccionSucursal").value = s.direccion;
    document.getElementById("telefonoSucursal").value = s.telefono;
    document.getElementById("onlineSucursal").value = s.online?1:0;
    document.getElementById("ventasHoySucursal").value = s.ventasHoy;
}

async function eliminarSucursal(id){
    if(!confirm("¿Deseas eliminar esta sucursal?")) return;
    await fetch("../backend/controllers/multisucursal/deleteSucursal.php", {
        method:"POST",
        body: JSON.stringify({id}),
    });
    cargarSucursales();
}

form.onsubmit = async e => {
    e.preventDefault();
    const sucursal = {
        id: document.getElementById("sucursalId").value,
        nombre: document.getElementById("nombreSucursal").value,
        direccion: document.getElementById("direccionSucursal").value,
        telefono: document.getElementById("telefonoSucursal").value,
        online: document.getElementById("onlineSucursal").value==1,
        ventasHoy: parseFloat(document.getElementById("ventasHoySucursal").value)
    };

    if(sucursal.id){
        await fetch("../backend/controllers/multisucursal/putSucursal.php", {
            method:"POST",
            body: JSON.stringify(sucursal),
        });
    } else {
        await fetch("../backend/controllers/multisucursal/postSucursal.php", {
            method:"POST",
            body: JSON.stringify(sucursal),
        });
    }

    modal.style.display="none";
    cargarSucursales();
};

document.addEventListener("DOMContentLoaded", cargarSucursales);
