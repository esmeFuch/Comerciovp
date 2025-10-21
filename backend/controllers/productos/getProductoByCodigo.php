<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$file = __DIR__ . '/../../data/productos.json';

if (!file_exists($file)) {
    echo json_encode([]);
    exit;
}

$productos = json_decode(file_get_contents($file), true) ?: [];

$codigo = $_GET['codigo'] ?? '';

if (!$codigo) {
    echo json_encode(["success" => false, "error" => "No se proporcionó código"]);
    exit;
}

// Buscar producto por código
$productoEncontrado = null;
foreach ($productos as $p) {
    if ($p['codigo'] === $codigo) {
        $productoEncontrado = $p;
        break;
    }
}

if ($productoEncontrado) {
    echo json_encode(["success" => true, "producto" => $productoEncontrado]);
} else {
    echo json_encode(["success" => false, "error" => "Producto no encontrado"]);
}
