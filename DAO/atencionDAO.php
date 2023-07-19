<?php

/**
 * Description of atencionDAO
 *
 * @author monso
 */
class atencionDAO {
    //put your code here
    function seleccionar(){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria", "3306");
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
    
    function seleccionar_idconsulta(atencion $atencion){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria", "3306");
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
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria", "3306");
        $sql ="INSERT INTO atencion (idcliente, fecha, comentario, idusu,idmascota, idusuario VALUES (?,NOW(),?,?,?,?)";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $idcliente = $atencion->getIdcliente();
        $com = $atencion->getComentario();
        $idusu = $atencion->getIdusu();
        $idmascota = $atencion->getIdmascota();
        $idusuario = $atencion->getIdusuario();
        mysqli_stmt_bind_param($stmt, "ssii",$idcliente, $com, $idusu,$idmascota, $idusuario);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
    function actualizar(atencion $atencion){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria", "3306");
        $sql =" UPDATE atencion SET idcliente=?,fecha=?,comentario=?,idusu=?,idmascota = ?, idusuario=? WHERE idatencion = ?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $id = $atencion->getIdatencion();
        $idcliente = $atencion->getIdcliente();
        $fecha = $atencion->getFecha();
        $com = $atencion->getComentario();
        $idusu = $atencion->getIdusu();
        $idmascota = $atencion->getIdmascota();
        $idusuario = $atencion->getIdusuario();
        mysqli_stmt_bind_param($stmt, "ssiii", $idcliente, $fecha, $com, $idusu, $idmascota, $idusuario, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
    function eliminar(atencion $atencion){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria", "3306");
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
