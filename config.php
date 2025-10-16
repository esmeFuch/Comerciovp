<?php
// Definir la página actual si no está definida
if (!isset($current_page)) {
    $current_page = "dashboard";
}

// Obtener la ruta base del proyecto
$base_path = $_SERVER['DOCUMENT_ROOT'];
$site_url = 'http://' . $_SERVER['HTTP_HOST'] . '/';
$project_folder = 'Comerciovp'; // Luego se cambia por url oficial externo

function create_url($page) {
    global $site_url, $project_folder;
    return $site_url . $project_folder . '/' . ltrim($page, '/');
}
?>