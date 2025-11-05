function calcularPorcentaje(actual, anterior) {
    if (anterior === 0) return actual === 0 ? 0 : 100;
    let porcentaje = ((actual - anterior) / anterior * 100);
    if (porcentaje > 100) porcentaje = 100;
    if (porcentaje < -100) porcentaje = -100;
    return porcentaje.toFixed(1);
}

function generarFooter(porc, texto) {
    const color = porc >= 0 ? 'green' : 'red';
    const icon = porc >= 0 ? 'fa-arrow-up' : 'fa-arrow-down';
    return `<span style="color:${color};"><i class="fas ${icon}"></i> ${Math.abs(porc)}% ${texto}</span>`;
}

async function cargarEstadisticas() {
    const ventasMesElem = document.getElementById("ventas-mes");
    const clientesNuevosElem = document.getElementById("clientes-nuevos");
    const ticketPromedioElem = document.getElementById("ticket-promedio");

    const ventasFooter = document.getElementById("ventas-mes-footer");
    const clientesFooter = document.getElementById("clientes-nuevos-footer");
    const ticketFooter = document.getElementById("ticket-promedio-footer");

    const topProductoNombre = document.getElementById("top-producto-nombre");
    const topProductoUnidades = document.getElementById("top-producto-unidades");
    const topProductosBody = document.getElementById("top-productos-body");

    try {
        const response = await fetch("../backend/controllers/estadisticas/getEstadisticas.php");
        const data = await response.json();

        // Totales
        ventasMesElem.textContent = `$${(data.ventasMes ?? 0).toFixed(2)}`;
        clientesNuevosElem.textContent = data.clientesNuevos ?? 0;
        ticketPromedioElem.textContent = `$${(data.ticketPromedio ?? 0).toFixed(2)}`;

        // Porcentajes
        const ventasPorc = calcularPorcentaje(data.ventasMes, data.ventasMesAnterior);
        const clientesPorc = calcularPorcentaje(data.clientesNuevos, data.clientesNuevosAnterior);
        const ticketPorc = calcularPorcentaje(data.ticketPromedio, data.ticketPromedioAnterior);

        ventasFooter.innerHTML = generarFooter(ventasPorc, "respecto al mes anterior");
        clientesFooter.innerHTML = generarFooter(clientesPorc, "más que el mes anterior");
        ticketFooter.innerHTML = generarFooter(ticketPorc, "respecto al mes anterior");

        // Top producto
        const top = data.topProductos?.[0] ?? { nombre: "-", unidades: 0 };
        topProductoNombre.textContent = top.nombre;
        topProductoUnidades.textContent = `${top.unidades} unidades vendidas`;

        // Tabla de top productos
        topProductosBody.innerHTML = "";
        (data.topProductos ?? []).forEach((p) => {
            topProductosBody.innerHTML += `
                <tr>
                    <td>${p.pos}</td>
                    <td>${p.nombre}</td>
                    <td>${p.categoria}</td>
                    <td>${p.unidades}</td>
                    <td>$${p.ingresos.toFixed(2)}</td>
                </tr>
            `;
        });

    } catch (error) {
        console.error("Error al cargar estadísticas:", error);
    }
}

document.addEventListener("DOMContentLoaded", cargarEstadisticas);
