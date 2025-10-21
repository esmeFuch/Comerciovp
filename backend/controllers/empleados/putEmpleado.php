<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$path = __DIR__ . '/../../data/empleados.json';
if (!file_exists($path)) {
    echo json_encode(['success' => false, 'message' => 'Archivo de empleados no encontrado']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input || !isset($input['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID no especificado']);
    exit;
}

$data = json_decode(file_get_contents($path), true);
if (!is_array($data)) $data = [];

$found = false;
foreach ($data as &$emp) {
    if (isset($emp['id']) && $emp['id'] === $input['id']) {
        // actualizamos solo los campos enviados (excepto id)
        foreach ($input as $k => $v) {
            if ($k === 'id') continue;
            $emp[$k] = $v;
        }
        $found = true;
        break;
    }
}

if (!$found) {
    echo json_encode(['success' => false, 'message' => 'Empleado no encontrado']);
    exit;
}

if (file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT)) !== false) {
    echo json_encode(['success' => true, 'message' => 'Empleado actualizado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al guardar cambios']);
}
