<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vacunaDAO
 *
 * @author Raul
 */
class vacunaDAO {
    function seleccionar(){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria", "3306");
        $sql ="select * from vacunas";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $vec = [];
        while($row = mysqli_fetch_assoc($resultData)){
            $vac= new vacuna($row['id_vac'], $row['nom_vac'],$row['des_vac']);
            $vec[]= $vac;
        }
        return $vec;
    }
    
    function crear(vacuna $vac){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria", "3306");
        $sql ="INSERT INTO vacunas (nom_vac,des_vac) VALUES (?,?)";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        //$id_usu = $user->getIdusuario();
        $nom_vac = $vac->getNom_vac();
        $des_vac = $vac->getDes_vac();
        mysqli_stmt_bind_param($stmt, "ss",$nom_vac,$nom_usu,$des_vac);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
