<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$file = __DIR__ . '/../../data/productos.json';

// Leemos el body del request
$input = json_decode(file_get_contents("php://input"), true);

if (!$input || !isset($input['id'])) {
    echo json_encode(["success" => false, "error" => "ID de producto no especificado"]);
    exit;
}

// Leemos productos existentes
$data = [];
if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
    if (!is_array($data)) $data = [];
}

// Filtramos el producto a eliminar
$nuevosProductos = array_filter($data, fn($p) => $p['id'] !== $input['id']);

// Verificamos si se eliminó
if (count($nuevosProductos) === count($data)) {
    echo json_encode(["success" => false, "error" => "Producto no encontrado"]);
    exit;
}

// Guardamos JSON actualizado
file_put_contents($file, json_encode(array_values($nuevosProductos), JSON_PRETTY_PRINT));
echo json_encode(["success" => true, "message" => "Producto eliminado correctamente"]);
