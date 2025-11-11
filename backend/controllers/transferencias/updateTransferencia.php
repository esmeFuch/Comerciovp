<?php
header('Content-Type: application/json');

$file_path = '../../data/transferencias.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['id']) || !isset($input['estado'])) {
        echo json_encode(["error" => "Datos insuficientes"]);
        exit;
    }

    if (file_exists($file_path)) {
        $json_data = json_decode(file_get_contents($file_path), true);

        foreach ($json_data as &$transferencia) {
            if ($transferencia['id'] == $input['id']) {
                $transferencia['estado'] = $input['estado'];
                break;
            }
        }

        file_put_contents($file_path, json_encode($json_data, JSON_PRETTY_PRINT));
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "Archivo no encontrado"]);
    }
} else {
    echo json_encode(["error" => "Método no permitido"]);
}
