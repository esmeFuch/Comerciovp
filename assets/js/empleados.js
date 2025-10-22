
document.addEventListener("DOMContentLoaded", async () => {
    const tbody = document.getElementById("empleadosBody");
    const modal = document.getElementById('modalEmpleado');
    const modalEliminar = document.getElementById('modalEliminar');
    const btnAgregar = document.getElementById('btnAgregar');
    const btnCerrar = document.getElementById('cerrarModalEmpleado');
    const btnGuardar = document.getElementById('guardarEmpleado');
    const modalTitle = document.getElementById('modalTitleEmpleado');

    let editMode = false;
    let editId = null;
    let eliminarId = null;

    async function cargarEmpleados() {
        try {
            const res = await fetch("../backend/controllers/empleados/getEmpleados.php");
            const data = await res.json();
            tbody.innerHTML = "";
            if (!data || data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;">No hay empleados registrados</td></tr>`;
                return;
            }
            data.forEach(emp => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td>${emp.id}</td>
                    <td>${emp.nombre}</td>
                    <td>${emp.email}</td>
                    <td>${emp.rol}</td>
                    <td>${emp.sucursal}</td>
                    <td><span class="${emp.estado==='Activo'?'positive':'negative'}">${emp.estado}</span></td>
                    <td>
                        <button class="btn" style="padding:5px 10px; background:var(--info); color:white;" onclick="editarEmpleado('${emp.id}')"><i class="fas fa-edit"></i></button>
                        <button class="btn" style="padding:5px 10px; background:var(--warning); color:white;" onclick="abrirEliminar('${emp.id}')"><i class="fas fa-trash"></i></button>
                    </td>`;
                tbody.appendChild(tr);
            });
        } catch(err) {
            tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;">Error al cargar empleados</td></tr>`;
            console.error(err);
        }
    }

    // ABRIR MODAL AGREGAR
    btnAgregar.addEventListener('click', () => {
        editMode = false; editId = null;
        modalTitle.textContent = "Agregar Empleado";
        document.getElementById('empleadoId').value='';
        document.getElementById('nombre').value='';
        document.getElementById('email').value='';
        document.getElementById('rol').value='';
        document.getElementById('sucursal').value='';
        document.getElementById('estado').value='Activo';
        modal.style.display = 'flex';
    });

    btnCerrar.addEventListener('click', () => modal.style.display='none');
    window.onclick = e => { if(e.target==modal) modal.style.display='none'; if(e.target==modalEliminar) modalEliminar.style.display='none'; };

    // EDITAR
    window.editarEmpleado = async (id) => {
        const fila = [...tbody.querySelectorAll('tr')].find(tr=>tr.children[0].textContent===id);
        editMode = true;
        editId = id;
        modalTitle.textContent='Editar Empleado';
        document.getElementById('empleadoId').value=id;
        document.getElementById('nombre').value = fila.children[1].textContent;
        document.getElementById('email').value = fila.children[2].textContent;
        document.getElementById('rol').value = fila.children[3].textContent;
        document.getElementById('sucursal').value = fila.children[4].textContent;
        document.getElementById('estado').value = fila.children[5].textContent;
        modal.style.display='flex';
    };

    // GUARDAR
    btnGuardar.addEventListener('click', async () => {
        const id = document.getElementById('empleadoId').value;
        const nombre = document.getElementById('nombre').value.trim();
        const email = document.getElementById('email').value.trim();
        const rol = document.getElementById('rol').value.trim();
        const sucursal = document.getElementById('sucursal').value.trim();
        const estado = document.getElementById('estado').value;
        if(!nombre||!email||!rol||!sucursal){ alert('Completa todos los campos'); return; }

        const url = editMode ? '../backend/controllers/empleados/putEmpleado.php' : '../backend/controllers/empleados/postEmpleado.php';
        const method = editMode ? 'PUT' : 'POST';
        const bodyData = editMode ? {id, nombre,email,rol,sucursal,estado} : {nombre,email,rol,sucursal,estado};

        try{
            const res = await fetch(url, {method, headers:{'Content-Type':'application/json'}, body: JSON.stringify(bodyData)});
            const data = await res.json();
            alert(data.message || (editMode ? 'Empleado actualizado' : 'Empleado agregado'));
            modal.style.display='none';
            cargarEmpleados();
        }catch(e){console.error(e); alert('Error al guardar empleado');}
    });

    // ELIMINAR
    window.abrirEliminar = (id) => { eliminarId=id; modalEliminar.style.display='flex'; };
    document.getElementById('cancelEliminar').addEventListener('click', ()=>modalEliminar.style.display='none');
    document.getElementById('confirmEliminar').addEventListener('click', async ()=>{
        if(!eliminarId) return;
        try{
            const res = await fetch('../backend/controllers/empleados/deleteEmpleado.php', {
                method:'DELETE',
                headers:{'Content-Type':'application/json'},
                body: JSON.stringify({id:eliminarId})
            });
            const data = await res.json();
            alert(data.message || 'Empleado eliminado');
            modalEliminar.style.display='none';
            cargarEmpleados();
        }catch(e){console.error(e); alert('Error al eliminar');}
    });

    cargarEmpleados();
});