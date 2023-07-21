<?php

class detalle_vacunaDAO{
    function seleccionar($id){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria", "3306");
        $sql ="select * from detallevacuna where idmascota=?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        mysqli_stmt_bind_param($stmt,"i",$id);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($resultData)){
            $dv= new detalle_vacuna($row['id_dv'],$row['fecha_dv'],$row['fechaproxima_dv'],$row['observacion_dv'],
                    $row['id_mas'],$id['id_vac']);
            return $dv;
        }else{
            return false;
        }
    }
    
    function crear(detalle_vacuna $dv){
        $cn = mysqli_connect("localhost", "root", "", "bd_veterinaria", "3306");
        $sql =" INSERT INTO detalle_vacuna (fecha_dv,fechaproxima_dv,observacion_dv,id_mas,id_vac) VALUES (CURRENT_DATE,?,?,?,?)";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $fecproxima_dv = $dv->getFecha_proxdet();
        $obs_dv = $dv->getObs();
        $id_mas = $dv->getIdMascota();
        $id_vac = $dv->getIdvacuna();
        mysqli_stmt_bind_param($stmt, "ssii", $fecproxima_dv , $obs_dv, $id_mas, $id_vac);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}