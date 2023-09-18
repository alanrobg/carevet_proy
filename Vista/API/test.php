<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
function seleccionar() {
    $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria", "3306");
    // Verificar si la conexión a la base de datos es exitosa
    if (!$cn) {
        http_response_code(500); // Error interno del servidor
        echo json_encode(array("message" => "Error de conexión a la base de datos"));
        exit();
    }
    $sql ="select * from cliente";
    $result = mysqli_query($cn, $sql);
    // Verificar si la consulta SQL fue exitosa
    if (!$result) {
        http_response_code(500); // Error interno del servidor
        echo json_encode(array("message" => "Error al ejecutar la consulta"));
        exit();
    }
    $clientes = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $cliente = array(
            "idcliente" => $row['idcliente'],
            "apellido_cli" => $row['apellido_cli'],
            "nombre_cli" => $row['nombre_cli'],
            "dni_cli" => $row['dni_cli'],
            "nacimiento_cli" => $row['nacimiento_cli'],
            "direccion_cli" => $row['direccion_cli'],
            "telefono_cli" => $row['telefono_cli'],
            "correo_cli" => $row['correo_cli'],
            "registro_cli" => $row['registro_cli'],
            "idusuario" => $row['idusuario']
        );
        $clientes[] = $cliente;
    }
    mysqli_close($cn);
    // Devolver los datos en formato JSON
    return $clientes; // Devuelve los datos en lugar de imprimirlos
}

// Llamamos a la función seleccionar() y almacenamos los datos en una variable
$datosClientes = seleccionar();

// Ahora, puedes utilizar $datosServicios en tu código JavaScript
echo json_encode($datosClientes);
?>
