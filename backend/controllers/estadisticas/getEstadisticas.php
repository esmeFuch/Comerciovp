<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$ventasFile = __DIR__ . '/../../data/ventas.json';
$productosFile = __DIR__ . '/../../data/productos.json';
$empleadosFile = __DIR__ . '/../../data/empleados.json';

$ventas = file_exists($ventasFile) ? json_decode(file_get_contents($ventasFile), true) : [];
$productos = file_exists($productosFile) ? json_decode(file_get_contents($productosFile), true) : [];
$empleados = file_exists($empleadosFile) ? json_decode(file_get_contents($empleadosFile), true) : [];

// Mes actual y mes anterior
$hoy = new DateTime();
$mesActual = $hoy->format('Y-m');           // Ej: 2025-10
$mesAnterior = (clone $hoy)->modify('-1 month')->format('Y-m');  // Ej: 2025-09

// Función para filtrar ventas por mes
function ventasPorMes($ventas, $mes) {
    return array_filter($ventas, fn($v) => strpos($v['fecha'] ?? '', $mes) === 0);
}

// Ventas totales
$ventasMesActual = array_sum(array_map(fn($v) => floatval($v['precio'] ?? 0) * intval($v['cantidad'] ?? 0), ventasPorMes($ventas, $mesActual)));
$ventasMesAnterior = array_sum(array_map(fn($v) => floatval($v['precio'] ?? 0) * intval($v['cantidad'] ?? 0), ventasPorMes($ventas, $mesAnterior)));

// Clientes nuevos
$clientesMesActual = count(ventasPorMes($ventas, $mesActual));
$clientesMesAnterior = count(ventasPorMes($ventas, $mesAnterior));

// Ticket promedio
$ticketActual = $clientesMesActual ? $ventasMesActual / $clientesMesActual : 0;
$ticketAnterior = $clientesMesAnterior ? $ventasMesAnterior / $clientesMesAnterior : 0;

// Top productos
$productosVendidos = [];
foreach(ventasPorMes($ventas, $mesActual) as $v){
    $nombre = $v['producto'] ?? '';
    $cantidad = intval($v['cantidad'] ?? 0);
    if(!$nombre) continue;
    if(!isset($productosVendidos[$nombre])) $productosVendidos[$nombre] = 0;
    $productosVendidos[$nombre] += $cantidad;
}
arsort($productosVendidos);
$topProductos = [];
$pos = 1;
foreach($productosVendidos as $nombre => $cant){
    if($pos > 10) break;
    $productoInfo = array_filter($productos, fn($p) => $p['nombre'] === $nombre);
    $productoInfo = $productoInfo ? array_values($productoInfo)[0] : ['categoria'=>'-','precio'=>0];
    $precio = floatval($productoInfo['precio'] ?? 0);
    $topProductos[] = [
        'pos' => $pos,
        'nombre' => $nombre,
        'categoria' => $productoInfo['categoria'] ?? '-',
        'unidades' => $cant,
        'ingresos' => $cant * $precio
    ];
    $pos++;
}

echo json_encode([
    'ventasMes' => $ventasMesActual ?: 0,
    'ventasMesAnterior' => $ventasMesAnterior ?: 0,
    'clientesNuevos' => $clientesMesActual ?: 0,
    'clientesNuevosAnterior' => $clientesMesAnterior ?: 0,
    'ticketPromedio' => $ticketActual ?: 0,
    'ticketPromedioAnterior' => $ticketAnterior ?: 0,
    'topProductos' => $topProductos ?: []
]);
