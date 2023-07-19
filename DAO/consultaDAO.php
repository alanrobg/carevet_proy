<?php

/**
 * Description of consultaDAO
 *
 * @author monso
 */
class consultaDAO {
    //put your code here
    function seleccionar(){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria", "3306");
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
    
    function seleccionar_idconsulta(consulta $consulta){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria", "3306");
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
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria", "3306");
        $sql ="INSERT INTO consulta (idcliente, fecha, comentario, idusu,idmascota, idusuario VALUES (?,NOW(),?,?,?,?)";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $idcliente = $consulta->getIdcliente();
        $com = $consulta->getComentario();
        $idusu = $consulta->getIdusu();
        $idmascota = $consulta->getIdmascota();
        $idusuario = $consulta->getIdusuario();
        mysqli_stmt_bind_param($stmt, "ssii",$idcliente, $com, $idusu,$idmascota, $idusuario);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
    function actualizar(consulta $consulta){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria", "3306");
        $sql =" UPDATE consulta SET idcliente=?,fecha=?,comentario=?,idusu=?,idmascota = ?, idusuario=? WHERE idconsulta = ?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $id = $consulta->getIdconsulta();
        $idcliente = $consulta->getIdcliente();
        $fecha = $consulta->getFecha();
        $com = $consulta->getComentario();
        $idusu = $consulta->getIdusu();
        $idmascota = $consulta->getIdmascota();
        $idusuario = $consulta->getIdusuario();
        mysqli_stmt_bind_param($stmt, "ssiii", $idcliente, $fecha, $com, $idusu,$idmascota, $idusuario, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
    function eliminar(consulta $consulta){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria", "3306");
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
