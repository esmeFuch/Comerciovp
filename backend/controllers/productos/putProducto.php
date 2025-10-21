<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type");

$file = __DIR__ . '/../../data/productos.json';

// Verificamos si el archivo existe
if (!file_exists($file)) {
    echo json_encode(["success" => false, "error" => "Archivo productos.json no encontrado"]);
    exit;
}

// Leemos el body del request
$input = json_decode(file_get_contents("php://input"), true);

if (!$input || !isset($input['id'])) {
    echo json_encode(["success" => false, "error" => "ID de producto no especificado"]);
    exit;
}

// Leemos todos los productos
$data = json_decode(file_get_contents($file), true);
if (!is_array($data)) $data = [];

// Buscamos el producto a modificar
$encontrado = false;
foreach ($data as &$producto) {
    if ($producto["id"] === $input["id"]) {
        foreach ($input as $clave => $valor) {
            if ($clave !== "id") {
                $producto[$clave] = $valor;
            }
        }
        $encontrado = true;
        break;
    }
}

// Guardamos el JSON actualizado
if ($encontrado) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(["success" => true, "message" => "Producto actualizado correctamente"]);
} else {
    echo json_encode(["success" => false, "error" => "Producto no encontrado"]);
}
