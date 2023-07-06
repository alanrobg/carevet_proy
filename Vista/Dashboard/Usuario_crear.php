<!DOCTYPE html>

<!--
Proyecto CareVet Veterinaria
-->


<?php
//---------------------------------------------------------------
//Recursos usuario
include_once '../../DAO/usuarioDAO.php';
include_once '../../DAO/sesionDAO.php';
include_once '../../DAO/usuario_areaDAO.php';
include_once '../../DAO/usuario_nivelDAO.php';
include_once '../../DAO/usuario_perfilDAO.php';
include_once '../../Modelo/sesion.php';
include_once '../../Modelo/usuario.php';
include_once '../../Modelo/usuario_area.php';
include_once '../../Modelo/usuario_nivel.php';
include_once '../../Modelo/usuario_perfil.php';

$usuariodao = new usuarioDAO();
$sesiondao = new sesionDAO();
$usuario_areadao = new usuario_areaDAO();
$usuario_niveldao = new usuario_nivelDAO();
$usuario_perfildao = new usuario_perfilDAO();
//---------------------------------------------------------------

//---------------------------------------------------------------
//Inicio de sesión
if(isset($_GET['data'])){
    $encoded_data = $_GET['data'];
    $data = unserialize(base64_decode($encoded_data));
    if(isset($data['key'])){
        $key = $data['key'];
        $sesion = new sesion(null, $key, null);
        $usuario =  $usuariodao->seleccionar_idusuario(new usuario($sesiondao->seleccionar_key_ses($sesion)->getIdusuario(), null, null, null, null, null, null, null, null, null));
        if($usuario==false){
            echo "<script>window.location.href='../login.php?error=sesionexpirada';</script>";
        }
    }else{
        echo "<script>window.location.href='../login.php?error=sesionexpirada';</script>";
    }
}else{
    echo "<script>window.location.href='../login.php?error=sesionexpirada';</script>";
}
//---------------------------------------------------------------

//---------------------------------------------------------------

?>
<html lang="en" >
<head>
  <?= include './links.php';?><title>SyS Company</title>
    
</head>
<body id="cuerpo">
    
    <!--HEADER -->
    <?php include '../Dashboard/Header.php';?>
    <!--HEADER -->
    
    <!--OFF_CANVAS -->
    <?php include '../SideBar/Usuario_offcanvas.php'?>
    <!--OFF_CANVAS -->
    
    <!--SIDEBAR -->
    <?php// include '../SideBar/BarUsuario.php';?>
    <!--SIDEBAR-->

<main class="main-content">
    <div class="container bg-light mt-5 rounded-3" id="Nosotros">
        <div class="container py-4">
            <div class="row my-3">

                <div class="col-sm-12 col-md-12 col-lg-12">

                    <h1 class="display-6 fw-bold text-black textoIzquierda">Agregar Usuario</h1>

                </div>

            </div>

        <div class="row my-3">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <form action="../Procesos/p_usuario1.php?data=<?=$encoded_data?>&accion=create" method="Post" enctype="multipart/form-data">
                        <table cellpadding="10" class="tabcell">
                            <tr class="tabcell">
                                <td style="flex-basis: 38%"><label>Apellido:<label style="color: red">*</label></label></td>
                                <td style="flex-basis: 62%">
                                    <input type="text" class="form-control" required="" name="apellido_usu" value="">
                                </td>
                            </tr>
                            <tr class="tabcell">
                                <td style="flex-basis: 38%"><label>Nombre:<label style="color: red">*</label></label></td>
                                <td style="flex-basis: 62%">
                                    <input type="text" class="form-control" required=""name="nombre_usu" value="">
                                </td>
                            </tr>
                            <tr class="tabcell">
                                <td style="flex-basis: 38%"><label>DNI:<label style="color: red">*</label></label></td>
                                <td style="flex-basis: 62%">
                                    <input class="form-control" step="1" minlength="8" maxlength="8" pattern="[0-9]+" required="" 
                                           type="text" name="dni_usu" value="">
                                </td>
                            </tr>
                            <tr class="tabcell">
                                <td style="flex-basis: 38%"><label>Email:<label style="color: red">*</label></label></td>
                                <td style="flex-basis: 62%">
                                    <input type="email" class="form-control" name="email_usu" value="">
                                </td>
                            </tr>
                            <tr class="tabcell">
                                <td  style="flex-basis: 38%"><label class="form-label">Seleccione un Area:<label style="color: red">*</label></label></td>
                                <td style="flex-basis: 62%">
                                    <select id="area" class="form-select"  name="idusuario_area">
                                    <option value="">Seleccione un Area</option>
                                    <?php
                                    foreach ($usuario_areadao->seleccionar() as $k=>$d) {
                                        $idarea="";
                                        $cad = "";
                                        $cad2 = "";
                                        if($d->getIdusuario_area()==$idarea){
                                            $cad2 = "selected";
                                        }else{
                                            $cad2 = "";
                                        }
                                        /*DATOS DE AREA*/
                                        $area = $usuario_areadao->seleccionar_idusuario_area
                                            (new usuario_area($d->getIdusuario_area(), null))->getNombre_usu_are();
                                        echo "<option value=".$d->getIdusuario_area()." ".$cad2.">"." ".$area."</option>";
                                        }
                                    ?>
                                    </select>
                                </td>
                            </tr>  
                            <tr class="tabcell">
                                <td style="flex-basis: 38%"><label class="form-label">Seleccione un Perfil:<label style="color: red">*</label></label></td>
                                <td style="flex-basis: 62%">
                                    <select id="area" class="form-select"  name="idusuario_perfil">
                                    <option value="">Seleccione un Perfil</option>
                                    <?php
                                    foreach ($usuario_perfildao->seleccionar() as $k=>$d) {
                                        $idperfil="";
                                        $cad = "";
                                        $cad2 = "";
                                        if($d->getIdusuario_perfil()==$idperfil){
                                            $cad2 = "selected";
                                        }else{
                                            $cad2 = "";
                                        }
                                        /*DATOS DE PERFIL*/
                                        $perfil = $usuario_perfildao->seleccionar_idusuario_perfil
                                            (new usuario_perfil($d->getIdusuario_perfil(), null))->getNombre_usu_per();
                                        echo "<option value=".$d->getIdusuario_perfil()." ".$cad2.">"." ".$perfil."</option>";
                                        }
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="tabcell">
                                <td style="flex-basis: 38%"><label class="form-label">Seleccione un Nivel:<label style="color: red">*</label></label></td>
                                <td style="flex-basis: 62%">
                                    <select id="nivel" class="form-select"  name="idusuario_nivel">
                                    <option value="">Seleccione un Nivel</option>
                                    <?php
                                    foreach ($usuario_niveldao->seleccionar() as $k=>$d) {
                                        $idnivel="";
                                        $cad = "";
                                        $cad2 = "";
                                        if($d->getIdusuario_nivel()==$idnivel){
                                            $cad2 = "selected";
                                        }else{
                                            $cad2 = "";
                                        }
                                        /*DATOS DE PERFIL*/
                                        $nivel = $usuario_niveldao->seleccionar_idusuario_nivel
                                            (new usuario_nivel($d->getIdusuario_nivel(), null, null))->getAcceso_usu_niv();
                                        echo "<option value=".$d->getIdusuario_nivel()." ".$cad2.">"." ".$nivel."</option>";
                                        }
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="tabcell">
                                <td style="flex-basis: 38%"><label>Usuario:<label style="color: red">*</label></label></td>
                                <td style="flex-basis: 62%">
                                    <input type="text"  required="" class="form-control" name="usuario_usu" value="">
                                </td>
                            </tr>
                            <tr class="tabcell">
                                <td style="flex-basis: 38%"><label>Password:<label style="color: red">*</label></label></td>
                                <td style="flex-basis: 62%">
                                    <input type="password" required="" class="form-control" name="password_usu" value="">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left"><br>
                                    <input class="btn btn-primary" type="submit" value="Agregar">
                                </td>
                            </tr>


                        </table>


                    </form>
                </div>
            </div>


                        </div>
            </div>
</div>
</main>
	<!-- Component End  -->

<script src="../recursos/main.js"></script>
</body>
</html>
