<!DOCTYPE html>

<!--
Proyecto CareVet Veterinaria
-->

<?php ?>

<?php
//---------------------------------------------------------------

//---------------------------------------------------------------
//Recursos usuario
include_once '../../Modelo/cliente.php';
include_once '../../Modelo/cliente_tipo.php';
include_once '../../DAO/clienteDAO.php';
include_once '../../DAO/cliente_tipoDAO.php';

$clienteDAO = new clienteDAO();
$cliente_tipoDAO = new cliente_tipoDAO();
//---------------------------------------------------------------
$accion = $_REQUEST['accion'];


?>
<html lang="en" >
<head>
  <?php include './links.php';?><title>SyS Company</title>
    

</head>
<body id="cuerpo">
    
    <!--HEADER -->
    <?php include '../Dashboard/Header.php';?>
    <!--HEADER -->
    
    <!--OFF_CANVAS -->
    <?php include '../SideBar/Cliente_offcanvas.php'?>
    <!--OFF_CANVAS -->
    
    <!--SIDEBAR -->
    <?php// include '../SideBar/BarCliente.php';?>
    <!--SIDEBAR-->

<main class="main-content">
    <div class="container bg-light mt-5 rounded-3" id="Nosotros">
        <div class="container py-4">
            <div class="row my-3">

                <div class="col-sm-12 col-md-12 col-lg-12">

                    <h1 class="display-6 fw-bold text-black textoIzquierda">Agregar Cliente</h1>

                </div>

            </div>
            
        <div class="row my-3">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form action="../Procesos/p_cliente.php?data=<?=$encoded_data?>&accion=<?=$accion?>" method="Post" enctype="multipart/form-data">
                    <table cellpadding="10" class="tabcell">
                        <input class="form-control" type="text" name="idusuario" value="<?=$aux?>" readonly="" hidden="">
                        
                        <tr class="tabcell">
                            <td style="flex-basis: 40%"><label>Apellido Paterno:<label style="color: red">*</label></label></td>
                            <td style="flex-basis: 60%">
                                <input class="form-control" required="" type="text" name="apellido_paterno_cli" value="">
                            </td>
                        </tr>
                        <tr class="tabcell">
                            <td style="flex-basis: 40%"><label>Apellido Materno:<label style="color: red">*</label></label></td>
                            <td style="flex-basis: 60%">
                                <input class="form-control" required="" type="text" name="apellido_materno_cli" value="">
                            </td>
                        </tr>
                        <tr class="tabcell">
                            <td style="flex-basis: 40%"><label>Nombre:<label style="color: red">*</label></label></td>
                            <td style="flex-basis: 60%">
                                <input class="form-control" required="" type="text" name="nombre_cli" value="">
                            </td>
                        </tr>
                        <tr class="tabcell">
                            <td style="flex-basis: 40%"><label>DNI:<label style="color: red">*</label></label></td>
                            <td style="flex-basis: 60%">
                                <input class="form-control" step="1"  required="" type="text" name="dni_cli" value="">
                            </td>
                        </tr>
                        <tr class="tabcell">
                            <td style="flex-basis: 40%"><label>Razon Social:<label style="color: red">*</label></label></td>
                            <td style="flex-basis: 60%">
                                <input class="form-control" required="" type="text" name="razon_social_cli" value="">
                            </td>
                        </tr>
                        <tr class="tabcell">
                            <td style="flex-basis: 40%"><label>RUC:<label style="color: red">*</label></label></td>
                            <td style="flex-basis: 60%">
                                <input class="form-control" step="1" required="" type="text" name="ruc_cli" value="">
                            </td>
                        </tr>
                        <tr class="tabcell">
                            <td style="flex-basis: 40%"><label>Tipo de Cliente:<label style="color: red">*</label></label></td>
                            <td style="flex-basis: 60%">
                                <select class="form-select"  name="idcliente_tipo" required="" >
                                    <option value="">Seleccione un tipo</option>
                                    <?php
                                    foreach ($cliente_tipoDAO->seleccionar() as $k=>$d) {
                                        $idserv="";
                                        $cad = "";
                                        $cad2 = "";
                                        if($d->getIdcliente_tipo()==$id){
                                            $cad2 = "selected";
                                        }else{
                                            $cad2 = "";
                                        }
                                        ///DATOS DE SERVICIO
                                        $id = $d->getIdcliente_tipo();
                                        $clitip = $cliente_tipoDAO->seleccionar_idcliente_tipo
                                                (new cliente_tipo($d->getIdcliente_tipo(), null))->getNombre_cli_tip();
                                        echo "<option value=".$d->getIdcliente_tipo()." ".$cad2.">"." ".$clitip."</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="tabcell">
                            <td style="flex-basis: 40%"><label>Dirección:</label></td>
                            <td style="flex-basis: 60%">
                                <input class="form-control" type="text" name="direccion_cli" value="">
                            </td>
                        </tr>
                        <tr class="tabcell">
                            <td style="flex-basis: 40%"><label>Telefono 1:<label style="color: red">*</label></label></td>
                            <td style="flex-basis: 60%">
                                <input class="form-control" step="1" required="" type="text" name="telefono1_cli" value="">
                            </td>
                        </tr>
                        <tr class="tabcell">
                            <td style="flex-basis: 40%"><label>Telefono 2:</label></td>
                            <td style="flex-basis: 60%">
                                <input class="form-control" step="1" type="text" name="telefono2_cli" value="">
                            </td>
                        </tr>
                        <tr class="tabcell">
                            <td style="flex-basis: 40%"><label>Telefono 3:</label></td>
                            <td style="flex-basis: 60%">
                                <input class="form-control" step="1" type="text" name="telefono3_cli" value="">
                            </td>
                        </tr>
                        <tr class="tabcell">
                            <td style="flex-basis: 40%"><label>Email:<label style="color: red">*</label></label></td>
                            <td style="flex-basis: 60%">
                                <input class="form-control" type="email" name="email_cli" value="" required="">
                            </td>
                        </tr>
                        <tr>
                            <td><br>
                                <input class="btn btn-primary" type="submit" value="Agregar">
                            </td>
                        </tr>
                        
                    </table>
                </form>
            </div>
        </div>
        </div>
    </div>
</main>
	<!-- Component End  -->

<script src="../recursos/main.js"></script>
</body>
</html>
