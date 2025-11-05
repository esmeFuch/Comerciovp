<?php
header("Content-Type: application/json");

// Recibir código del producto a eliminar
$codigo = $_GET['codigo'] ?? null;

if (!$codigo) {
    echo json_encode(['success' => false, 'error' => 'Código de producto no enviado']);
    exit;
}

// Ruta del archivo de ventas
$ventasFile = __DIR__ . '/../../data/ventas.json';
$ventas = file_exists($ventasFile) ? json_decode(file_get_contents($ventasFile), true) : [];

// Filtrar los productos que no coincidan con el código
$ventas = array_filter($ventas, fn($v) => $v['codigo'] !== $codigo);

// Guardar cambios
file_put_contents($ventasFile, json_encode(array_values($ventas), JSON_PRETTY_PRINT));

echo json_encode(['success' => true, 'message' => 'Producto eliminado correctamente']);
