<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$file = __DIR__ . '/../../data/productos.json';

if (!file_exists($file)) {
    echo json_encode([]);
    exit;
}

$data = json_decode(file_get_contents($file), true);
if (!is_array($data)) $data = [];

echo json_encode($data);
