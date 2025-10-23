<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Archivos JSON
$ventasFile = __DIR__ . '/../../data/ventas.json';
$productosFile = __DIR__ . '/../../data/productos.json';

// Crear archivos si no existen
if (!file_exists($ventasFile)) file_put_contents($ventasFile, json_encode([]));
if (!file_exists($productosFile)) file_put_contents($productosFile, json_encode([]));

// Leer body
$input = json_decode(file_get_contents("php://input"), true);
if (!$input || !isset($input['productos']) || !is_array($input['productos'])) {
    echo json_encode(["success" => false, "error" => "Datos incompletos o JSON inválido"]);
    exit;
}

// Leer ventas y productos
$ventas = json_decode(file_get_contents($ventasFile), true);
$productos = json_decode(file_get_contents($productosFile), true);
if (!is_array($ventas)) $ventas = [];
if (!is_array($productos)) $productos = [];

// Procesar cada producto de la venta
foreach ($input['productos'] as $p) {
    $codigo = $p['codigo'];
    $cantidadVendida = (int)$p['cantidad'];

    // Buscar producto por código
    $index = null;
    foreach ($productos as $i => $prod) {
        if ($prod['codigo'] === $codigo) {
            $index = $i;
            break;
        }
    }

    if ($index === null) {
        echo json_encode(["success" => false, "error" => "Producto con código $codigo no encontrado"]);
        exit;
    }

    // Verificar stock
    if ($productos[$index]['stock'] < $cantidadVendida) {
        echo json_encode(["success" => false, "error" => "Stock insuficiente para " . $productos[$index]['nombre']]);
        exit;
    }

    // Restar stock
    $productos[$index]['stock'] -= $cantidadVendida;

    // Registrar venta
    $ventas[] = [
        "codigo" => $codigo,
        "producto" => $productos[$index]['nombre'],
        "cantidad" => $cantidadVendida,
        "precio" => $p['precio'],
        "metodo_pago" => $input['metodo_pago'],
        "fecha" => date("Y-m-d H:i:s")
    ];
}

// Guardar cambios
file_put_contents($productosFile, json_encode($productos, JSON_PRETTY_PRINT));
file_put_contents($ventasFile, json_encode($ventas, JSON_PRETTY_PRINT));

echo json_encode(["success" => true, "message" => "Venta registrada correctamente"]);
