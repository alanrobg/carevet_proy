<?php

/* 
 * Proy. S&S Travels International
 */


//---------------------------------------------------------------
//Recursos usuario
include_once '../Dashboard/session.php';
//---------------------------------------------------------------

//---------------------------------------------------------------
//---------------------------------------------------------------


$accion = $_REQUEST['accion'];

if($accion=="create"){
    $usuario = new usuario(null, $_POST['apellido_usu'], $_POST['nombre_usu'], $_POST['dni_usu'], $_POST['direccion'], $_POST['nacimiento'], $_POST['telefono'],
            $_POST['correo'], $_POST['contrato'], $_POST['idarea'], $_POST['usuario'], $_POST['password']);
    
    $usuarioDNI = $usuarioDAO->seleccionarxDNI($_POST['dni_usu']);
    $usuarioUSU = $usuarioDAO->seleccionarxUSUARIO($_POST['usuario_usu']);
    
    if(empty($usuarioDNI) && empty($usuarioUSU)){
        $usuarioDAO->crear($usuario);
        $aux = 1;
    }else{
        echo "<script>window.location.href='../Dashboard/Usuario_lista.php?data=$encoded_data&error=dup';</script>";
    }

    if ($aux == 1){
        echo "<script>window.location.href='../Dashboard/Usuario_lista.php?data=$encoded_data';</script>";
    }
}

if($accion=="update"){
    $usuario = new usuario(null, $_POST['apellido_usu'], $_POST['nombre_usu'], $_POST['dni_usu'], $_POST['direccion'], $_POST['nacimiento'], $_POST['telefono'],
            $_POST['correo'], $_POST['contrato'], $_POST['idarea'], $_POST['usuario'], $_POST['password']);
    
    $usuarioDNI = $usuarioDAO->seleccionarxDNIupdate($_REQUEST['id_usu'], $_POST['dni_usu']);
    $usuarioUSU = $usuarioDAO->seleccionarxUSUARIOupdate($_REQUEST['id_usu'], $_POST['usuario_usu']);
    
    if(empty($usuarioDNI) && empty($usuarioUSU)){
        $usuarioDAO->actualizar($usuario);
        $aux = 1;
    }else{
        echo "<script>window.location.href='../Dashboard/Usuario_lista.php?data=$encoded_data&error=dup';</script>";
    }

    if ($aux == 1){
        echo "<script>window.location.href='../Dashboard/Usuario_lista.php?data=$encoded_data';</script>";
    }
} 

if($accion=="delete"){
    $usuario = new usuario(null, $_POST['nombre_usu'], $_POST['apellido_usu'], $_POST['dni_usu'], $_POST['idusuario_area'], 
            $_POST['idusuario_perfil'], $_POST['idusuario_nivel'], $_POST['usuario_usu'], $_POST['password_usu'], $_POST['email_usu']);
    $usuario = new usuario($_REQUEST['id_usu'], null, null, null, null, null, null, null, null, null);
    //$usuariodao->eliminar($usuario);
    echo "<script>window.location.href='../Dashboard/Usuario_lista.php?data=$encoded_data&error=eliminacionexitosa';</script>";
}