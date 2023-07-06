<?php



class usuarioDAO {
    
    
    function seleccionar_idusuario(usuario $usuario){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria");
        $sql = "select ape_usuario, nom_usuario, dni_usuario, direccion_usuario, nacimiento_usuario, telefono_usuario, correo_usuario, contrato_usuario, idarea, "
                . "usu_usuario, pass_usuario from usuario where idusuario= ?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $idusu = $usuario->getIdusuario();
        mysqli_stmt_bind_param($stmt, "i", $idusu);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($resultData)){
            $usu = new usuario($idusu,$row['ape_usuario'], $row['nom_usuario'], $row['dni_usuario'], $row['direccion_usuario'], $row['nacimiento_usuario'],
                    $row['telefono_usuario'], $row['correo_usuario'], $row['contrato_usuario'], $row['idarea'], $row['usu_usuario'], $row['pass_usuario']);
            return $usu;
        }else{
            return false;
        }
    }
    
    function seleccionar_usuario_usu_password_usu(usuario $usuario){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria");
        $sql = "select idusuario from usuario where usu_usuario=? AND pass_usuario=?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $usu_usu = $usuario->getUsu_usuario();
        $hashedpwd = hash('sha256', $usuario->getPass_usuario());
        mysqli_stmt_bind_param($stmt, "ss", $usu_usu,$hashedpwd);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($resultData)){
            $usu = new usuario($row['idusuario'],null, null, null, null, null,null, null, null, null, null, null);
            return $usu;
        }else{
            return false;
        }
    }
    
    function seleccionar(){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria");
        $sql = "select * from usuario";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $vec = [];
        while($row = mysqli_fetch_assoc($resultData)){
            $usuario = new usuario($row['idusuario'],$row['ape_usuario'], $row['nom_usuario'], $row['dni_usuario'], $row['direccion_usuario'], $row['nacimiento_usuario'],
                    $row['telefono_usuario'], $row['correo_usuario'], $row['contrato_usuario'], $row['idarea'], $row['usu_usuario'], $row['pass_usuario']);
            $vec[]= $usuario;
        }
        return $vec;
    }
    
    function crear(usuario $user){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria");
        $sql ="INSERT INTO usuario (ape_usuario,nom_usuario,dni_usuario,direccion_usuario,nacimiento_usuario,telefono_usuario"
                . ",correo_usuario,contrato_usuario,idarea,usu_usuario,pass_usuario) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        //$id_usu = $user->getIdusuario();
        $ape_usu = $user->getApellido_usuario();
        $nom_usu = $user->getNombre_usuario();
        $dni_usu = $user->getDni_usuario();
        $dir_usu = $user->getDireccion_usuario();
        $nac_usu = $user->getNacimiento_usuario();
        $telf_usu = $user->getTelefono_usuario();
        $email_usu = $user->getCorreo_usuario();
        $cont_usu = $user->getContrato_usuario();
        $ida_usu = $user->getIdearea();
        $usu_usu = $user->getUsu_usuario();
        $hashedpwd = hash('sha256', $user->getPass_usuario());
        mysqli_stmt_bind_param($stmt, "ssssssssiss",$ape_usu,$nom_usu,$dni_usu,$dir_usu,$nac_usu,$telf_usu,$email_usu,$cont_usu,$ida_usu,
                $usu_usu,$hashedpwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}