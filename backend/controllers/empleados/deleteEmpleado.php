<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$path = __DIR__ . '/../../data/empleados.json';
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID no especificado']);
    exit;
}

$data = file_exists($path) ? json_decode(file_get_contents($path), true) : [];
if (!is_array($data)) $data = [];

$new = array_values(array_filter($data, function($e) use ($input) {
    return !isset($e['id']) || $e['id'] !== $input['id'];
}));

if (count($new) === count($data)) {
    echo json_encode(['success' => false, 'message' => 'Empleado no encontrado']);
    exit;
}

if (file_put_contents($path, json_encode($new, JSON_PRETTY_PRINT)) !== false) {
    echo json_encode(['success' => true, 'message' => 'Empleado eliminado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al guardar cambios']);
}
