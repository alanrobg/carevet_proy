<?php
include_once '../../DAO/mascotaDAO.php';

$mascotaDAO = new mascotaDAO();

// Supongamos que tienes un método en tu mascotaDAO que obtiene las subcategorías según la categoría seleccionada
if (isset($_GET['cliente_id'])) {
$clientId = $_GET['cliente_id'];
$mascotas = $mascotaDAO->seleccionarxCliente($clientId);
$mascotasArr = [];
foreach ($mascotas as $mascota) {
    $mascotaObject = array('id' => $mascota->getIdmascota(), 'name' => $mascota->getNom_mascota());
    array_push($mascotasArr, $mascotaObject);
}
// Devolvemos las subcategorías en formato JSON
header('Content-Type: application/json');
echo json_encode($mascotasArr);
exit;
}

?>