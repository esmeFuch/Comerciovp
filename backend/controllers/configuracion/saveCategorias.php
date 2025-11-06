<?php
header('Content-Type: application/json');

$archivo = __DIR__ . '/../../data/categorias.json';

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['categorias']) || !is_array($data['categorias'])) {
    echo json_encode(['success' => false, 'error' => 'Datos inválidos']);
    exit;
}

// Guardar las categorías
file_put_contents($archivo, json_encode($data['categorias'], JSON_PRETTY_PRINT));

echo json_encode(['success' => true, 'message' => 'Categorías guardadas correctamente']);
