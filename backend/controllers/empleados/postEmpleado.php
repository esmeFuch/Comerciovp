<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { // para CORS preflight
    http_response_code(200);
    exit;
}

$path = __DIR__ . '/../../data/empleados.json';
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['nombre'], $input['email'], $input['rol'], $input['sucursal'], $input['estado'])) {
    echo json_encode(['success' => false, 'message' => 'Faltan campos obligatorios']);
    exit;
}

// leer existentes
$data = [];
if (file_exists($path)) {
    $data = json_decode(file_get_contents($path), true);
    if (!is_array($data)) $data = [];
}

// generar ID único tipo EMP### sin colisiones
$maxNum = 0;
foreach ($data as $e) {
    if (isset($e['id']) && preg_match('/EMP(\d+)/', $e['id'], $m)) {
        $n = intval($m[1]);
        if ($n > $maxNum) $maxNum = $n;
    }
}
$nextNum = $maxNum + 1;
$newId = 'EMP' . str_pad($nextNum, 3, '0', STR_PAD_LEFT);

$nuevo = [
    'id' => $newId,
    'nombre' => $input['nombre'],
    'email' => $input['email'],
    'rol' => $input['rol'],
    'sucursal' => $input['sucursal'],
    'estado' => $input['estado']
];

$data[] = $nuevo;

if (file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT)) !== false) {
    echo json_encode(['success' => true, 'message' => 'Empleado agregado correctamente', 'empleado' => $nuevo]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al guardar el empleado']);
}
