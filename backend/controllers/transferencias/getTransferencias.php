<?php
header('Content-Type: application/json');
$data_file = '../../data/transferencias.json';

$transferencias = json_decode(file_get_contents($data_file), true);

// Si se pasa un ID, devolver solo una transferencia
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $transferencia = array_filter($transferencias, fn($t) => $t['id'] == $id);
    echo json_encode(array_shift($transferencia));
    exit;
}

echo json_encode($transferencias);
