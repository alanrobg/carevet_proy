<?php
include_once __DIR__.'/../constants/environment.php';
/**
 * Description of atencionDAO
 *
 * @author monso
 */
class atencionDAO {
    //put your code here
    function seleccionar(){
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $sql ="select * from atencion";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $vec = [];
        while($row = mysqli_fetch_assoc($resultData)){
            $atencion= new atencion($row['idatencion'], $row['idcliente'],$row['fecha'],$row['comentario'],$row['idusu'],$row['idmascota'],$row['idusuario']);
            $vec[]= $atencion;
        }
        return $vec;
    }
    
    function seleccionarDesc(){
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $sql ="select * from atencion order by idatencion DESC";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $vec = [];
        while($row = mysqli_fetch_assoc($resultData)){
            $atencion= new atencion($row['idatencion'], $row['idcliente'],$row['fecha'],$row['comentario'],$row['idusu'],$row['idmascota'],$row['idusuario']);
            $vec[]= $atencion;
        }
        return $vec;
    }
    
    function seleccionar_idatencion(atencion $atencion){
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $sql = "select * from atencion where idatencion = ?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $idatencion = $atencion->getIdatencion();
        mysqli_stmt_bind_param($stmt, "i", $idatencion);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($resultData)){
            $atencion= new atencion($row['idatencion'], $row['idcliente'],$row['fecha'],$row['comentario'],$row['idusu'],$row['idmascota'],$row['idusuario']);
            return $atencion;
        }else{
            return false;
        }
    }
    
    function crear(atencion $atencion){
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $sql ="INSERT INTO atencion (idcliente, fecha, comentario, idusu,idmascota, idusuario) VALUES (?,NOW(),?,?,?,?)";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $idcliente = $atencion->getIdcliente();
        $com = $atencion->getComentario();
        $idusu = $atencion->getIdusu();
        $idmascota = $atencion->getIdmascota();
        $idusuario = $atencion->getIdusuario();
        mysqli_stmt_bind_param($stmt, "isiii",$idcliente, $com, $idusu,$idmascota, $idusuario);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
    function actualizar(atencion $atencion){
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $sql =" UPDATE atencion SET idcliente=?,comentario=?,idusu=?,idmascota = ? WHERE idatencion = ?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $id = $atencion->getIdatencion();
        $idcliente = $atencion->getIdcliente();
        $com = $atencion->getComentario();
        $idusu = $atencion->getIdusu();
        $idmascota = $atencion->getIdmascota();
        mysqli_stmt_bind_param($stmt, "isiii", $idcliente, $com, $idusu, $idmascota, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
    function eliminar(atencion $atencion){
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $sql =" delete from atencion WHERE idatencion=?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $idc = $atencion->getIdatencion();
        mysqli_stmt_bind_param($stmt,"i",$idc);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
