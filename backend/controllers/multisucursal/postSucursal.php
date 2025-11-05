<?php
// Crea una nueva sucursal
header("Content-Type: application/json; charset=utf-8");
$sucursalesFile = __DIR__ . '/../../data/sucursales.json';

// recibir JSON
$input = json_decode(file_get_contents("php://input"), true);
if (!is_array($input)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'JSON inválido']);
    exit;
}

// validación básica
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

// leer archivo (si no existe, se crea luego)
$sucursales = file_exists($sucursalesFile) ? json_decode(file_get_contents($sucursalesFile), true) : [];
if (!is_array($sucursales)) $sucursales = [];

// generar id único (más entropía)
$id = uniqid('', true);

$nueva = [
    'id' => (string)$id,
    'nombre' => $nombre,
    'direccion' => $direccion,
    'telefono' => $telefono,
    'online' => $online,
    'ventasHoy' => $ventasHoy
];

// escribir con lock para evitar condiciones de carrera
$sucursales[] = $nueva;
file_put_contents($sucursalesFile, json_encode($sucursales, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL, LOCK_EX);

echo json_encode(['status' => 'success', 'data' => $nueva]);
