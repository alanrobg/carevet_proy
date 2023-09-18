<?php

include_once '../../DAO/clienteDAO.php';
include_once '../../Modelo/cliente.php';

$clienteDAO = new clienteDAO();


// Verifica que se está recibiendo una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lee los datos JSON desde el cuerpo de la solicitud
    $json_data = file_get_contents('php://input');
    
    // Decodifica los datos JSON en un arreglo asociativo
    $data = json_decode($json_data, true);

    // Puedes acceder a los valores de la siguiente manera
    $apellido_cli = $data['apellido_cli'];
    $nombre_cli = $data['nombre_cli'];
    $dni_cli = $data['dni_cli'];
    $nacimiento_cli = $data['nacimiento_cli'];
    $direccion_cli = $data['direccion_cli'];
    $telefono_cli = $data['telefono_cli'];
    $correo_cli = $data['correo_cli'];
    $idusuario = $data['idusuario'];

    // Ahora puedes usar estos datos para realizar acciones, como insertar en la base de datos o escribir en registro_api.txt
    $logFile = 'registro_api.txt'; // Nombre del archivo de registro
    $logData = "Fecha y hora: " . date('Y-m-d H:i:s') . "\n";
    $logData .= "apellido_cli: " . $apellido_cli . "\n";
    $logData .= "nombre_cli: " . $nombre_cli . "\n";
    $logData .= "dni_cli: " . $dni_cli . "\n";
    $logData .= "nacimiento_cli: " . $nacimiento_cli . "\n";
    $logData .= "direccion_cli: " . $direccion_cli . "\n";
    $logData .= "telefono_cli: " . $telefono_cli . "\n";
    $logData .= "correo_cli: " . $correo_cli . "\n";
    $logData .= "idusuario: " . $idusuario . "\n\n";
    
    file_put_contents($logFile, $logData, FILE_APPEND);
    // Insertar en la base de datos o realizar otras operaciones aquí
    $cliente = new cliente(null, $apellido_cli, $nombre_cli, $dni_cli, $nacimiento_cli, $direccion_cli, $telefono_cli, $correo_cli, null, $idusuario);
    
    //FALTA VALIDAR DNI DUPLICADOS
    $clienteDAO->crear($cliente);
    
    // Luego, si deseas devolver una respuesta, puedes hacerlo en formato JSON
    $response = [
        'message' => 'Datos recibidos correctamente',
    ];
    // Envía la respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si no es una solicitud POST, puedes manejarlo de acuerdo a tus necesidades
    echo 'Acceso no autorizado';
}