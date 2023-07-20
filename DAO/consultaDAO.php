<?php

/**
 * Description of consultaDAO
 *
 * @author monso
 */
class consultaDAO {
    //put your code here
    function seleccionar(){
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $sql ="select * from consulta";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $vec = [];
        while($row = mysqli_fetch_assoc($resultData)){
            $consulta= new consulta($row['idconsulta'], $row['idcliente'],$row['fecha'],$row['comentario'],$row['idusu'],$row['idmascota'],$row['idusuario']);
            $vec[]= $consulta;
        }
        return $vec;
    }
    
    function seleccionarDesc(){
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $sql ="select * from consulta order by idconsulta DESC";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $vec = [];
        while($row = mysqli_fetch_assoc($resultData)){
            $consulta= new consulta($row['idconsulta'], $row['idcliente'],$row['fecha'],$row['comentario'],$row['idusu'],$row['idmascota'],$row['idusuario']);
            $vec[]= $consulta;
        }
        return $vec;
    }
    
    function seleccionar_idconsulta(consulta $consulta){
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $sql = "select * from consulta where idconsulta = ?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $idconsulta = $consulta->getIdconsulta();
        mysqli_stmt_bind_param($stmt, "i", $idconsulta);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($resultData)){
            $consulta= new consulta($row['idconsulta'], $row['idcliente'],$row['fecha'],$row['comentario'],$row['idusu'],$row['idmascota'],$row['idusuario']);
            return $consulta;
        }else{
            return false;
        }
    }
    
    function crear(consulta $consulta){
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $sql ="INSERT INTO consulta (idcliente, fecha, comentario, idusu, idmascota, idusuario) VALUES (?,NOW(),?,?,?,?)";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $idcliente = $consulta->getIdcliente();
        $com = $consulta->getComentario();
        $idusu = $consulta->getIdusu();
        $idmascota = $consulta->getIdmascota();
        $idusuario = $consulta->getIdusuario();
        mysqli_stmt_bind_param($stmt, "isiii",$idcliente, $com, $idusu,$idmascota, $idusuario);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
    function actualizar(consulta $consulta){
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $sql =" UPDATE consulta SET idcliente=?,comentario=?,idusu=?,idmascota = ? WHERE idconsulta = ?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $id = $consulta->getIdconsulta();
        $idcliente = $consulta->getIdcliente();
        $com = $consulta->getComentario();
        $idusu = $consulta->getIdusu();
        $idmascota = $consulta->getIdmascota();
        mysqli_stmt_bind_param($stmt, "isiii", $idcliente, $com, $idusu,$idmascota, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
    function eliminar(consulta $consulta){
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $sql =" delete from consulta WHERE idconsulta=?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $idc = $consulta->getIdconsulta();
        mysqli_stmt_bind_param($stmt,"i",$idc);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
