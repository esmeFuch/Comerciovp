<?php
// Actualiza una sucursal por id
header("Content-Type: application/json; charset=utf-8");
$sucursalesFile = __DIR__ . '/../../data/sucursales.json';

$input = json_decode(file_get_contents("php://input"), true);
if (!is_array($input) || empty($input['id'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'JSON inválido o falta id']);
    exit;
}

$id = (string)$input['id'];
$nombre = trim($input['nombre'] ?? '');
$direccion = trim($input['direccion'] ?? '');
$telefono = trim($input['telefono'] ?? '');
$online = isset($input['online']) ? (bool)$input['online'] : false;
$ventasHoy = isset($input['ventasHoy']) ? (int)$input['ventasHoy'] : 0;

if ($nombre === '' || $direccion === '') {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Faltan campos obligatorios']);
    exit;
}

$sucursales = file_exists($sucursalesFile) ? json_decode(file_get_contents($sucursalesFile), true) : [];
if (!is_array($sucursales)) $sucursales = [];

$found = false;
foreach ($sucursales as &$s) {
    if ((string)$s['id'] === $id) {
        $s['nombre'] = $nombre;
        $s['direccion'] = $direccion;
        $s['telefono'] = $telefono;
        $s['online'] = $online;
        $s['ventasHoy'] = $ventasHoy;
        $found = true;
        break;
    }
}
unset($s);

if (!$found) {
    http_response_code(404);
    echo json_encode(['status' => 'error', 'message' => 'Sucursal no encontrada']);
    exit;
}

// escribir con lock
file_put_contents($sucursalesFile, json_encode($sucursales, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL, LOCK_EX);

echo json_encode(['status' => 'success']);
