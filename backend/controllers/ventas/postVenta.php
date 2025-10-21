<?php
error_reporting(E_ALL);
ini_set('display_errors', 0); // Evita que errores rompan el JSON
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// 📂 Ruta absoluta al archivo JSON
$file = __DIR__ . '/../../data/ventas.json';

// Crear archivo si no existe
if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}

// 📥 Leer datos del body
$input = json_decode(file_get_contents("php://input"), true);

if (!$input || !isset($input['productos']) || !is_array($input['productos'])) {
    echo json_encode(["success" => false, "error" => "Datos incompletos o JSON inválido"]);
    exit;
}

// Leer ventas existentes
$data = json_decode(file_get_contents($file), true);
if (!is_array($data)) $data = [];

// Agregar cada producto
foreach ($input['productos'] as $p) {
    $data[] = [
        "producto" => $p["nombre"],
        "cantidad" => $p["cantidad"],
        "precio" => $p["precio"],
        "metodo_pago" => $input['metodo_pago'],
        "fecha" => date("Y-m-d H:i:s")
    ];
}

// Guardar ventas en JSON
if (file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT))) {
    echo json_encode(["success" => true, "message" => "Venta registrada correctamente"]);
} else {
    echo json_encode(["success" => false, "error" => "Error al guardar la venta"]);
}
