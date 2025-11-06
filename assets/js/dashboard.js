function calcularPorcentaje(actual, anterior) {
    if (anterior === 0) return actual === 0 ? 0 : 100;
    let porcentaje = ((actual - anterior) / anterior) * 100;
    // Limitar entre -100 y 100
    if (porcentaje > 100) porcentaje = 100;
    if (porcentaje < -100) porcentaje = -100;
    return porcentaje.toFixed(1);
}

async function cargarDashboard() {
    try {
        const response = await fetch("backend/controllers/dashboard/getDashboard.php");
        const data = await response.json();

        // Elementos cards
        const ventasElem = document.getElementById("ventasHoy");
        const productosElem = document.getElementById("productosVendidos");
        const clientesElem = document.getElementById("clientesAtendidos");
        const ticketElem = document.getElementById("ticketPromedio");

        const ventasFooter = document.getElementById("ventasHoyPorc");
        const productosFooter = document.getElementById("productosVendidosPorc");
        const clientesFooter = document.getElementById("clientesAtendidosPorc");
        const ticketFooter = document.getElementById("ticketPromedioPorc");

        // Actualizar valores
        ventasElem.textContent = `$${(data.ventasHoy ?? 0).toFixed(2)}`;
        productosElem.textContent = data.productosHoy ?? 0;
        clientesElem.textContent = data.clientesHoy ?? 0;
        ticketElem.textContent = `$${(data.ticketHoy ?? 0).toFixed(2)}`;

        // Porcentajes
        const ventasPorc = calcularPorcentaje(data.ventasHoy, data.ventasAyer);
        const productosPorc = calcularPorcentaje(data.productosHoy, data.productosAyer);
        const clientesPorc = calcularPorcentaje(data.clientesHoy, data.clientesAyer);
        const ticketPorc = calcularPorcentaje(data.ticketHoy, data.ticketAyer);

        // Función para generar HTML de footer con color completo
        function generarFooter(porc) {
            const color = porc >= 0 ? 'green' : 'red';
            const icon = porc >= 0 ? 'fa-arrow-up' : 'fa-arrow-down';
            return `<span style="color:${color};"><i class="fas ${icon}"></i> ${Math.abs(porc)}% respecto a ayer</span>`;
        }

        // Actualizar footers
        ventasFooter.innerHTML = generarFooter(ventasPorc);
        productosFooter.innerHTML = generarFooter(productosPorc);
        clientesFooter.innerHTML = generarFooter(clientesPorc);
        ticketFooter.innerHTML = generarFooter(ticketPorc);

    } catch (error) {
        console.error("Error al cargar dashboard:", error);
    }
}

document.addEventListener("DOMContentLoaded", cargarDashboard);
