<!DOCTYPE html>

<!--
Proyecto CareVet Veterinaria
-->

<?php

//---------------------------------------------------------------
include_once './session.php';
//---------------------------------------------------------------

//---------------------------------------------------------------
//Recursos usuario
include_once '../../DAO/atencionDAO.php';
include_once '../../Modelo/atencion.php';

$atencionDAO = new atencionDAO();
//---------------------------------------------------------------

//---------------------------------------------------------------
//Recursos usuario
include_once '../../DAO/clienteDAO.php';
include_once '../../Modelo/cliente.php';

$clienteDAO = new clienteDAO();
//---------------------------------------------------------------

//---------------------------------------------------------------
//Recursos usuario
include_once '../../DAO/mascotaDAO.php';
include_once '../../Modelo/mascota.php';

$mascotaDAO = new mascotaDAO();
//---------------------------------------------------------------

//---------------------------------------------------------------
//Recursos usuario
include_once '../../DAO/esterilizacionDAO.php';
include_once '../../Modelo/esterilizacion.php';

$esterilizacionDAO = new esterilizacionDAO();
//---------------------------------------------------------------


//---------------------------------------------------------------
//Recursos usuario
include_once '../../DAO/razaDAO.php';
include_once '../../Modelo/raza.php';

$razaDAO = new razaDAO();
//---------------------------------------------------------------

//---------------------------------------------------------------
//Recursos usuario
include_once '../../DAO/especieDAO.php';
include_once '../../Modelo/especie.php';

$especieDAO = new especieDAO();
//---------------------------------------------------------------

$idatencion = $_REQUEST['idatencion'];

$atencion = $atencionDAO->seleccionar_idatencion(new atencion($idatencion, null, null, null, null, null, null));

$idcliente = $atencion->getIdcliente();
$idtrabajador = $atencion->getIdusu();
$idmascota = $atencion->getIdmascota();
$fecha = date("H:s  d/m/Y", strtotime($atencion->getFecha()));
$com = $atencion->getComentario();
$idusuario = $atencion->getIdusuario();


?>
<html lang="en">
<head>
    <?php include './links.php';?>
    <title>CareVet Veterinaria</title>
</head>
<body id="cuerpo">
    
    <!--HEADER -->
    <?php include './Header.php';?>
    <!--HEADER -->
    
<main class="main-content">
    
<div class="container bg-light mt-5 rounded-3" id="Nosotros">
    <div class="container py-4">	
        <div class="row my-3">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h1 class="display-6 fw-bold text-black textoIzquierda">Atencion de Servicios</h1>
            </div>
        </div>
        <div class="row my-3">
            <!-- Inicio Reserva Temp-------------------------------------------------------------------------- -->  
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form class="formulario" method="post" action="">
                    <table cellpadding="10" class="tabcell">
                        <tr class="tabcell">
                            <td style="flex-basis: 30%"><label>ID ATENCION:</label></td>
                            <td style="flex-basis: 70%">
                                <input size="30" readonly="" type="text" class="form-control" required="" name="" value="<?=$idatencion?>">
                            </td>
                        </tr>
                        <tr class="tabcell">
                            <td style="flex-basis: 30%"><label>Cliente:</label></td>
                            <td style="flex-basis: 70%">
                                <input readonly="" type="text" class="form-control" required="" name="" value="<?=$com?>">
                            </td>
                        </tr>
                        <tr class="tabcell">
                            <td style="flex-basis: 30%"><label>Trabajador:</label></td>
                            <td style="flex-basis: 70%">
                                <input readonly="" type="text" class="form-control" required="" name="" value="<?=$com?>">
                            </td>
                        </tr>
                        <tr class="tabcell">
                            <td style="flex-basis: 30%"><label>Fecha de registro:</label></td>
                            <td style="flex-basis: 70%">
                                <input readonly="" type="text" class="form-control" required="" name="" value="<?=$fecha?>">
                            </td>
                        </tr>
                        <tr class="tabcell">
                            <td style="flex-basis: 30%"><label>Comentarios:</label></td>
                            <td style="flex-basis: 70%">
                                <textarea class="form-control" rows="3" cols="10" readonly=""><?=$com?></textarea>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="row my-3">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table>
                        <tr>
                            <td><h2>Mascota</h2></td>
                            <td>&emsp;</td>
                            <td><button data-bs-toggle="modal" data-bs-target="#detailsvacuna" class="btn btn-primary">Vacunas</button></td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table border='' class="ttable" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Raza</th>
                                <th>Especie</th>
                                <th></th>
                            </tr>
                        </thead>

                        <!--FOREACH-->
                        <?php
                        $mascota = $mascotaDAO->seleccionar_idmascota(new mascota($idmascota, null, null, null, null, null, null, null, null));
                        $nom_mascota = $mascota->getNom_mascota();
                        $actual = date("Y-m-d");
                        $anios = date_diff(date_create($mascota->getNacimiento_mascota()), date_create($actual))->y;
                        $meses = date_diff(date_create($mascota->getNacimiento_mascota()), date_create($actual))->m;
                        $esteri = $esterilizacionDAO->seleccionar_idesterilizacion(new esterilizacion($mascota->getIdesterilizacion(), null))->getNom_esterilizacion();
                        $raza = $razaDAO->seleccionar_idraza(new raza($mascota->getIdraza(), null, null));
                        $especie = $especieDAO->seleccionar_idespecie(new especie($raza->getIdespecie(), null));
                        ?>
                        <tr>
                            <td><?=$nom_mascota?></td>
                            <td><?=$anios." Años y ".$meses." meses"?></td>
                            <td><?=$raza->getNom_raza()?></td>
                            <td><?=$especie->getNom_especie()?></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailsmascota<?=$idmascota?>">
                                    Detalles
                                </button>
                            </td>
                            <div class="modal fade" id="detailsmascota<?=$idmascota?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-title">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Datos de la Mascota</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="input-group mb-3">
                                                  <label style="flex-basis: 40%" class="input-group-text">Nombre:</label>
                                                  <input style="flex-basis: 60%" type="text" class="form-control" value="<?=$mascota->getNom_mascota()?>" readonly="">
                                                </div>
                                                <div class="input-group mb-3">
                                                  <label style="flex-basis: 40%" class="input-group-text">Cliente:</label>
                                                  <input style="flex-basis: 60%" type="text" class="form-control" value="<?=$mascota->getIdcliente()?>" readonly="">
                                                </div>
                                                <div class="input-group mb-3">
                                                  <label style="flex-basis: 40%" class="input-group-text">Nacimiento:</label>
                                                  <input style="flex-basis: 60%" type="text" class="form-control" value="<?=date("d/m/Y", strtotime($mascota->getNacimiento_mascota())) ?>" readonly="">
                                                </div>
                                                <div class="input-group mb-3">
                                                  <label style="flex-basis: 40%" class="input-group-text">Color:</label>
                                                  <input style="flex-basis: 60%" type="text" class="form-control" value="<?=$mascota->getColor_mascota()?>" readonly="">
                                                </div>
                                                <div class="input-group mb-3">
                                                  <label style="flex-basis: 40%" class="input-group-text">Fecha de registro:</label>
                                                  <input style="flex-basis: 60%" type="text" class="form-control" value="<?=date("H:m d/m/Y", strtotime($mascota->getRegistro_mascota()))?>" readonly="">
                                                </div>
                                                <div class="input-group mb-3">
                                                  <label style="flex-basis: 40%" class="input-group-text">Foto:</label>
                                                  <a class="btn btn-primary" target="_blanck" href="../<?=substr($mascota->getFoto_mascota(),33)?>">Abrir</a>
                                                </div>
                                                <div class="input-group mb-3">
                                                  <label style="flex-basis: 40%" class="input-group-text">Esterilizado:</label>
                                                  <input style="flex-basis: 60%" type="text" class="form-control" value="<?=$esteri?>" readonly="">
                                                </div>
                                                <div class="input-group mb-3">
                                                  <label style="flex-basis: 40%" class="input-group-text">Raza:</label>
                                                  <input style="flex-basis: 60%" type="text" class="form-control" value="<?=$mascota->getIdraza()?>" readonly="">
                                                </div>
                                                <div class="input-group mb-3">
                                                  <label style="flex-basis: 40%" class="input-group-text">Especie:</label>
                                                  <input style="flex-basis: 60%" type="text" class="form-control" value="" readonly="">
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update<?=$idmascota?>">Editar</button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        </div>
</div>
</main>
	<!-- Component End  -->

  
</body>
<script src="../recursos/main.js"></script>
</html>
