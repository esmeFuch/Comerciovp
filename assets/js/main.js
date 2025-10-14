// Simulación de datos en tiempo real
function updateRealTimeData() {
    // Simular cambios en los datos de ventas
    const salesValue = document.querySelector('.dashboard-cards .card:nth-child(1) .card-value');
    if (salesValue) {
        const currentValue = parseInt(salesValue.textContent.replace('$', '').replace(',', ''));
        const randomChange = Math.floor(Math.random() * 100) - 30; // Cambio aleatorio entre -30 y +70
        const newValue = Math.max(10000, currentValue + randomChange);
        salesValue.textContent = '$' + newValue.toLocaleString();
    }
    
    // Simular cambios en productos vendidos
    const productsValue = document.querySelector('.dashboard-cards .card:nth-child(2) .card-value');
    if (productsValue) {
        const currentProducts = parseInt(productsValue.textContent);
        const productChange = Math.floor(Math.random() * 10) - 2; // Cambio aleatorio entre -2 y +8
        const newProducts = Math.max(300, currentProducts + productChange);
        productsValue.textContent = newProducts;
    }
    
    // Actualizar cada 10 segundos
    setTimeout(updateRealTimeData, 10000);
}

// Iniciar la actualización de datos en tiempo real
document.addEventListener('DOMContentLoaded', function() {
    updateRealTimeData();
});