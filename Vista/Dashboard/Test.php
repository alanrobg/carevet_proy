<!DOCTYPE html>

<!--
Proyecto CareVet Veterinaria
-->


<?php
$privilegio = 3;

//---------------------------------------------------------------
include_once './session.php';
//---------------------------------------------------------------


//---------------------------------------------------------------
//Recursos usuario
include_once '../../DAO/clienteDAO.php';
include_once '../../Modelo/cliente.php';

$clienteDAO = new clienteDAO();
//---------------------------------------------------------------

?>
<html lang="en" >
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
                    <h1 class="display-6 fw-bold text-black izquierdo">Clientes Registrados</h1>
                </div>
            </div>        
            <div class="row my-3">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table>
                        <tr>
                            <td align="right" style="padding-right: 5px">
                                Busqueda:
                            </td>
                            <td>
                                <input class="form-control" type="text" name="buscador" id="buscador" placeholder="Buscar...">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">

                    <table border="1" width="80%" class="ttable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th colspan="3">Apellido</th>
                                <th>Nombre</th>
                                <th>DNI</th>
                            </tr>
                        </thead>
                        <!--FOREACH-->
                        <?php
                        foreach ($clienteDAO->seleccionar() as $k=>$d){
                            //DATOS DE SERVICIO
                            $id = $d->getIdcliente();
                            $ape = $d->getApellido_cli();
                            $nom = $d->getNombre_cli();
                            $dni = $d->getDni_cli();
                            $nac = date("d/m/Y", strtotime($d->getNacimiento_cli()));
                            $actual = date("Y-m-d");
                            $edad = date_diff(date_create($d->getNacimiento_cli()), date_create($actual))->y;
                            $direc = $d->getDireccion_cli();
                            $tel = $d->getTelefono_cli();
                            $correo = $d->getCorreo_cli();
                            $registro = date("d/m/Y", strtotime($d->getRegistro_cli()));
                        ?>
                        <tr class="articulo">
                            <td><?=$id?></td>
                            <td><?=$ape?></td>
                            <td><?=$nom?></td>
                            <td><?=$dni?></td>
                        </tr>           
                        <?php    
                        }
                        ?>
                        <tr>
                            <td colspan="3"></td>
                            <td>TOTAL $31312</td>
                        </tr> 
                    <!--FIN FOREACH-->
                    </table>
                </div>
            </div>  
        </div>
    </div>
</main>
	<!-- Component End  -->
<script src="../recursos/main.js"></script>
</body>
</html>
