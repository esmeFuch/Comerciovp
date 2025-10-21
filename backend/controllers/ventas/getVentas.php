<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$file = __DIR__ . '/../data/ventas.json';

if (!file_exists($file)) {
    echo json_encode([]);
    exit;
}

$ventas = json_decode(file_get_contents($file), true) ?: [];
echo json_encode($ventas);
