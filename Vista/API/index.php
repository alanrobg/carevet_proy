<?php

// Encabezados para permitir solicitudes desde cualquier origen (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Incluye los archivos con la lógica de servicios y trabajadores
include_once './services.php';
include_once './workers.php';

// Verifica el método de solicitud HTTP
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Obtiene los datos de servicios y trabajadores
    $services = seleccionar();
    $workers = trabajadores_lista();

    // Combina los datos en una respuesta JSON
    $combinedData = array("services" => $services, "workers" => $workers);
    echo json_encode($combinedData);
} else {
    // Devuelve un error si el método no es compatible
    http_response_code(405);
    echo json_encode(array("message" => "Método no permitido"));
}


?>