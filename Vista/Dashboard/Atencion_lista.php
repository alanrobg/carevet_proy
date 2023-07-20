<!DOCTYPE html>

<!--
Proyecto CareVet Veterinaria
-->


<?php

//---------------------------------------------------------------
include_once './session.php';
//---------------------------------------------------------------

//---------------------------------------------------------------
//Recursos usuario
include_once '../../DAO/atencionDAO.php';
include_once '../../Modelo/atencion.php';

$atencionDAO = new atencionDAO();
//---------------------------------------------------------------

//---------------------------------------------------------------
//Recursos usuario
include_once '../../DAO/mascotaDAO.php';
include_once '../../Modelo/mascota.php';

$mascotaDAO = new mascotaDAO();
//---------------------------------------------------------------

//---------------------------------------------------------------
//Recursos usuario
include_once '../../DAO/razaDAO.php';
include_once '../../Modelo/raza.php';

$razaDAO = new razaDAO();
//---------------------------------------------------------------

//---------------------------------------------------------------
//Recursos usuario
include_once '../../DAO/especieDAO.php';
include_once '../../Modelo/especie.php';

$especieDAO = new especieDAO();
//---------------------------------------------------------------

//---------------------------------------------------------------
//Recursos usuario
include_once '../../DAO/clienteDAO.php';
include_once '../../Modelo/cliente.php';

$clienteDAO = new clienteDAO();
//---------------------------------------------------------------

?>
<html lang="en" >
<head>
    <?php include './links.php';?>
    <title>CareVet Veterinaria</title>
</head>
<!-------------------------------------------------SCRIPT PARA BUSQUEDA------------------------------------------------->
<script>
document.addEventListener("keyup", e=>{

  if (e.target.matches("#buscador")){

      if (e.key ==="Escape")e.target.value = ""

      document.querySelectorAll(".articulo").forEach(fruta =>{

          fruta.textContent.toLowerCase().includes(e.target.value.toLowerCase())
            ?fruta.classList.remove("filtro")
            :fruta.classList.add("filtro")
      })

  }


})
</script>

<!-------------------------------------------------SCRIPT PARA CLI_DUPLICADOS------------------------------------------------->
<script>
    <?php
    if(isset($_REQUEST['error'])){
        if($_REQUEST['error'] == "dup"){
            ?>
            window.onload = function() {
            alert("El DNI ingresado se repite en otro Cliente");
            }
            <?php
        }
    }
    ?>
</script>

<body id="cuerpo">
    
    <!--HEADER -->
    <?php include './Header.php';?>
    <!--HEADER -->
    
<?php include './Modal/Atencion_new.php';?>
<main class="main-content">
<div class="container bg-light mt-5 rounded-3" id="Nosotros">
        <div class="container py-4">
            <div class="row my-3">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h1 class="display-6 fw-bold text-black izquierdo">Atenciones Registrados</h1>
                </div>
            </div>
            <style>
                .filtro{
                    display: none;
                }
            </style>
                             
            <div class="row my-3">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table>
                        <tr>
                            <td align="right" style="padding-right: 5px">
                                Busqueda:
                            </td>
                            <td>
                                <input class="form-control" type="text" name="buscador" id="buscador" placeholder="Buscar...">
                            </td>
                            <td>&emsp;</td>
                            <td>
                                <button class="btn btn-primary" data-bs-target="#newatencion" data-bs-toggle="modal">Nueva Atencion</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">

                    <table border="1" width="100%" class="ttable">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Trabajador</th>
                                <th>Mascota</th>
                                <th>Comentario</th>
                                <th></th>
                            </tr>
                        </thead>
                        <!--FOREACH-->
                        <?php
                        foreach ($atencionDAO->seleccionarDesc() as $ka=>$dat){
                            //DATOS DE SERVICIO
                            $id = $dat->getIdatencion();
                            $cliente = $clienteDAO->seleccionar_idcliente(new cliente($dat->getIdcliente(), null, null, null, null, null, null, null, null, null));
                            $nomcli = $cliente->getNombre_cli(); $apecli = $cliente->getApellido_cli();
                            $nommascota = $mascotaDAO->seleccionar_idmascota(new mascota
                                    ($dat->getIdmascota(), null, null, null, null, null, null, null, null))->getNom_mascota();
                            $trabajador = $usuarioDAO->seleccionar_idusuario(new usuario($dat->getIdusu(), null, null, null, null, null, null, null, null, null, null, null));
                            $nomtra = $trabajador->getNombre_usuario(); $apetra = $trabajador->getApellido_usuario();
                            $fecha = date("H:s d/m/Y", strtotime($dat->getFecha()));
                            $com = $dat->getComentario();
                        ?>
                        <tr class="articulo">
                            <td><?=$nomcli." ".$apecli?></td>
                            <td><?=$fecha?></td>
                            <td><?=$nomtra." ".$apetra?></td>
                            <td><?=$nommascota?></td>
                            <td><textarea class="form-control" rows="2" cols="20" readonly=""><?=$com?></textarea></td>
                            <td><a class="btn btn-primary" href="./Atencion_detalle.php?data=<?=$encoded_data?>&idatencion=<?=$id?>">Detalles</a></td>
                        </tr>           

                        <?php    
                        }

                        ?>
                    <!--FIN FOREACH-->
                    </table>
                </div>
            </div>  
        </div>
    </div>
</main>
	<!-- Component End  -->
<script src="../recursos/main.js"></script>
</body>
</html>
