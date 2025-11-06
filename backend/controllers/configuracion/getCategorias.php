<?php
header('Content-Type: application/json');

$archivo = __DIR__ . '/../../data/categorias.json';

if (!file_exists($archivo)) {
    file_put_contents($archivo, json_encode([]));
}

$categorias = json_decode(file_get_contents($archivo), true);

echo json_encode($categorias);
