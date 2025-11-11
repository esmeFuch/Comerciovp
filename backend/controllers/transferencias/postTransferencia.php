<?php
header('Content-Type: application/json');
$data_file = '../../data/transferencias.json';

// Leer el archivo de transferencias o inicializarlo si está vacío
$transferencias = json_decode(file_get_contents($data_file), true) ?? [];
$input = json_decode(file_get_contents('php://input'), true);

// Validar entrada
if (!$input) {
    echo json_encode(['status' => 'error', 'message' => 'Datos inválidos']);
    exit;
}

// Asignar un ID único
$input['id'] = uniqid('TRF-'); 
$input['fecha'] = date('d-m-Y');

// Agregar la transferencia
$transferencias[] = $input;

// Guardar en archivo
if (file_put_contents($data_file, json_encode($transferencias, JSON_PRETTY_PRINT))) {
    echo json_encode(['status' => 'success', 'message' => 'Transferencia guardada']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al guardar la transferencia']);
}
