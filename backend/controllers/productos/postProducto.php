<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$file = __DIR__ . '/../../data/productos.json';
$input = json_decode(file_get_contents("php://input"), true);

if (!$input || !isset($input['codigo'], $input['nombre'], $input['precio'], $input['stock'])) {
    echo json_encode(["success" => false, "error" => "Faltan campos obligatorios"]);
    exit;
}

// Leer productos existentes
$data = [];
if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
    if (!is_array($data)) $data = [];
}

// Validar que el código sea único
foreach ($data as $p) {
    if ($p['codigo'] === $input['codigo']) {
        echo json_encode(["success" => false, "error" => "Ya existe un producto con ese código de barras"]);
        exit;
    }
}

// Generar ID único
$ids = array_column($data, 'id');
$nextId = $ids ? max($ids) + 1 : 1;

// Crear producto
$nuevoProducto = [
    "id" => (string)$nextId,
    "codigo" => $input['codigo'],
    "nombre" => $input['nombre'],
    "categoria" => $input['categoria'] ?? "",
    "precio" => floatval($input['precio']),
    "stock" => intval($input['stock'])
];

$data[] = $nuevoProducto;
file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

echo json_encode(["success" => true, "message" => "Producto agregado correctamente", "producto" => $nuevoProducto]);
