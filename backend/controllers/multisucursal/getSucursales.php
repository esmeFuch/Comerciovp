<?php
// Devuelve todas las sucursales en JSON
header("Content-Type: application/json; charset=utf-8");
$sucursalesFile = __DIR__ . '/../../data/sucursales.json';

$sucursales = [];
if (file_exists($sucursalesFile)) {
    $json = file_get_contents($sucursalesFile);
    if ($json !== false && trim($json) !== '') {
        $data = json_decode($json, true);
        if (is_array($data)) $sucursales = $data;
    }
}

// devolver array (aunque esté vacío)
echo json_encode($sucursales, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
