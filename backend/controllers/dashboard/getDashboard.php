<?php 
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$ventasFile = __DIR__ . '/../../data/ventas.json';
$ventas = file_exists($ventasFile) ? json_decode(file_get_contents($ventasFile), true) : [];

// Fechas
$hoy = (new DateTime())->format('Y-m-d');
$ayer = (new DateTime('-1 day'))->format('Y-m-d');

// Función para filtrar ventas por fecha (solo YYYY-MM-DD)
function ventasPorDia($ventas, $fecha) {
    return array_filter($ventas, function($v) use ($fecha) {
        if (!isset($v['fecha'])) return false;
        $fechaVenta = substr($v['fecha'], 0, 10); // Tomamos solo la parte YYYY-MM-DD
        return $fechaVenta === $fecha;
    });
}

$ventasHoyArray = ventasPorDia($ventas, $hoy);
$ventasAyerArray = ventasPorDia($ventas, $ayer);

// Ventas totales (monto)
$ventasHoy = array_sum(array_map(fn($v) => floatval($v['precio']) * intval($v['cantidad']), $ventasHoyArray));
$ventasAyer = array_sum(array_map(fn($v) => floatval($v['precio']) * intval($v['cantidad']), $ventasAyerArray));

// Productos vendidos
$productosHoy = array_sum(array_map(fn($v) => intval($v['cantidad']), $ventasHoyArray));
$productosAyer = array_sum(array_map(fn($v) => intval($v['cantidad']), $ventasAyerArray));

// Clientes (una venta = un cliente nuevo)
$clientesHoy = count($ventasHoyArray);
$clientesAyer = count($ventasAyerArray);

// Ticket promedio
$ticketHoy = $clientesHoy ? $ventasHoy / $clientesHoy : 0;
$ticketAyer = $clientesAyer ? $ventasAyer / $clientesAyer : 0;

echo json_encode([
    'ventasHoy' => $ventasHoy,
    'ventasAyer' => $ventasAyer,
    'productosHoy' => $productosHoy,
    'productosAyer' => $productosAyer,
    'clientesHoy' => $clientesHoy,
    'clientesAyer' => $clientesAyer,
    'ticketHoy' => $ticketHoy,
    'ticketAyer' => $ticketAyer
]);
