<?php
// Elimina sucursal por id
header("Content-Type: application/json; charset=utf-8");
$sucursalesFile = __DIR__ . '/../../data/sucursales.json';

$input = json_decode(file_get_contents("php://input"), true);
if (!is_array($input) || empty($input['id'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'JSON inválido o falta id']);
    exit;
}

$id = (string)$input['id'];

$sucursales = file_exists($sucursalesFile) ? json_decode(file_get_contents($sucursalesFile), true) : [];
if (!is_array($sucursales)) $sucursales = [];

$filtered = array_values(array_filter($sucursales, function($s) use ($id) {
    return (string)($s['id'] ?? '') !== $id;
}));

if (count($filtered) === count($sucursales)) {
    // no se eliminó nada
    http_response_code(404);
    echo json_encode(['status' => 'error', 'message' => 'Sucursal no encontrada']);
    exit;
}

// escribir con lock
file_put_contents($sucursalesFile, json_encode($filtered, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL, LOCK_EX);

echo json_encode(['status' => 'success']);
