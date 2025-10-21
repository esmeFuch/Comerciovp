<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$path = __DIR__ . '/../../data/empleados.json';

if (!file_exists($path)) {
    // devolver array vacío si no existe todavía
    echo json_encode([]);
    exit;
}

$data = json_decode(file_get_contents($path), true);
if (!is_array($data)) $data = [];

echo json_encode($data);
