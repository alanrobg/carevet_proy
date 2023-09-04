<!DOCTYPE html>

<!--
Proyecto CareVet Veterinaria
-->


<?php
$privilegio = 3;

//---------------------------------------------------------------
include_once './session.php';
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
    <?php //include './links.php';?>
    <title>CareVet Veterinaria</title>
    <meta charset="UTF-8">
    <link href="../recursos/datatable.css" rel="stylesheet" type="text/css"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css'>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap 5 CSS (asegúrate de incluirlo antes de los estilos de DataTables) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables CSS y JavaScript -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- DataTables Buttons CSS y JavaScript -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <!-- DataTables Responsive CSS y JavaScript -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
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
    
    
<main class="main-content">
<div class="container bg-light mt-5 rounded-3" id="Nosotros">
        <div class="container py-4">
            <div class="row my-3">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h1 class="display-6 fw-bold text-black izquierdo">Clientes Registrados</h1>
                </div>
            </div>
            <?php include './Modal/Cliente_new.php';?>
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
                                <button class="btn btn-primary" data-bs-target="#newcliente" data-bs-toggle="modal">Nuevo Cliente</button>
                            </td>
                        </tr>
                    </table>
                </div>
                
<script>
$(document).ready(function () {
    // Objeto para almacenar los valores de idservicio
    var idclientePorIdFila = {};
    var apellidoPorFila = {};
    var nombrePorFila = {};
    var dniPorFila = {};
    var nacimientoPorFila = {};
    var telefonoPorFila = {};
    var emailPorFila = {};
    var registroPorFila = {};

    // Recorre las filas y asigna un valor de idservicio basado en el data-idservicio
    $('#mytable tr').each(function () {
        var fila = $(this);
        var idfila = fila.data('idfila');
        
        var idcliente = fila.data('idcliente');
        var apellidocli = fila.data('apellidocli');
        var nombrecli = fila.data('nombrecli');
        var dnicli = fila.data('dnicli');
        var nacimientocli = fila.data('nacimientocli');
        var telefonocli = fila.data('telefonocli');
        var emailcli = fila.data('emailcli');
        var registrocli = fila.data('registrocli');
        
        idclientePorIdFila[idfila] = idcliente;
        apellidoPorFila[apellidocli] = apellidocli;
        nombrePorFila[nombrecli] = nombrecli;
        dniPorFila[dnicli] = dnicli;
        nacimientoPorFila[nacimientocli] = nacimientocli;
        telefonoPorFila[telefonocli] = telefonocli;
        emailPorFila[emailcli] = emailcli;
        registroPorFila[registrocli] = registrocli;
    });

    /*
    // Muestra los valores de idfila y idservicio en la consola
    for (var idfila in idservicioPorIdFila) {
        if (idservicioPorIdFila.hasOwnProperty(idfila)) {
            if (idfila !== undefined && idservicioPorIdFila[idfila] !== undefined) {
                console.log('ID de fila: ' + idfila + ', ID de servicio: ' + idservicioPorIdFila[idfila]);
            }
        }
    }
    */
    
    // Inicializa DataTables
    $('#mytable').DataTable({
        // Configuración de DataTables
    });

    // Agrega un controlador de eventos clic a los botones de "Ver detalles"
    $('#mytable').on('click', '.ver-detalles', function () {
        var fila = $(this).closest('tr');
        
        var idcliente = fila.data('idcliente');
        var apellidocli = fila.data('apellidocli');
        var nombrecli = fila.data('nombrecli');
        var dnicli = fila.data('dnicli');
        var nacimientocli = fila.data('nacimientocli');
        var direccioncli = fila.data('direccioncli');
        var telefonocli = fila.data('telefonocli');
        var emailcli = fila.data('emailcli');
        var registrocli = fila.data('registrocli');

        // Verifica si la fila tiene un ID de servicio definido
        if (idcliente !== undefined) {
            
            console.clear();
            console.log(idcliente);
            console.log(apellidocli);
            console.log(nombrecli);
            console.log(dnicli);
            console.log(nacimientocli);
            console.log(direccioncli);
            console.log(telefonocli);
            console.log(emailcli);
            console.log(registrocli);
            
            $('#idcliente').val(idcliente);
            $('#apellidocli').val(apellidocli);
            $('#nombrecli').val(nombrecli);
            $('#dnicli').val(dnicli);
            $('#nacimientocli').val(nacimientocli);
            $('#direccioncli').val(direccioncli);
            $('#telefonocli').val(telefonocli);
            $('#emailcli').val(emailcli);
            $('#registrocli').val(registrocli);
            
            // Abre el modal
            $('#myModal').modal('show');
            
        } else {
            // La fila de detalles está oculta o no tiene un ID de servicio definido
            var filaPrincipal = fila.prevAll('tr[data-idservicio]').first();
            
            var idfilaPrincipal = filaPrincipal.data('idfila');
            //var idservicioP = filaPrincipal.data('idservicio');
            var nomservicioP = filaPrincipal.data('nomservicio');
            var tiposervicioP = filaPrincipal.data('tiposervicio');
            var idproveedorP = filaPrincipal.data('idproveedor');
            var nomproveedorP = filaPrincipal.data('nomproveedor');
            var detallesP = filaPrincipal.data('detallesservicio');
            
            
            var idservicioPrincipal = idservicioPorIdFila[idfilaPrincipal];
            var nomservicioPrincipal = nomservicioPorFila[nomservicioP];
            var tiposervicioPrincipal = tiposervicioPorFila[tiposervicioP];
            var idproveedorPrincipal = idproveedorPorFila[idproveedorP];
            var nomproveedorPrincipal = nomproveedorPorFila[nomproveedorP];
            var detallesPrincipal = detallesPorFila[detallesP];
            
            if (idservicioPrincipal !== undefined) {
                console.clear();
                console.log(idservicioPrincipal);
                console.log(nomservicioPrincipal);
                console.log(tiposervicioPrincipal);
                console.log(idproveedorPrincipal);
                console.log(nomproveedorPrincipal);
                console.log(detallesPrincipal);
                $('#idservicio').val(idservicioPrincipal);
                $('#nomservicio').val(nomservicioPrincipal);
                $('#tiposervice').val(tiposervicioPrincipal);
                $('#idproveedor').val(idproveedorPrincipal);
                $('#nomproveedor').val(nomproveedorPrincipal);
                $('#detservicio').val(detallesPrincipal);
                // Abre el modal
                $('#myModal').modal('show');
            }
        }
    });
    
    // Asigna un controlador de eventos clic al botón "Editar"
    $('#btnEditar').on('click', function () {
        
        // Obtén los valores de los campos en el primer modal
        var idcliente = $('#idcliente').val();
        var apellidocli = $('#apellidocli').val();
        var nombrecli = $('#nombrecli').val();
        var dnicli = $('#dnicli').val();
        var nacimientocli = $('#nacimientocli').val();
        var direccioncli = $('#direccioncli').val();
        var telefonocli = $('#telefonocli').val();
        var emailcli = $('#emailcli').val();
        var registrocli = $('#registrocli').val();

        // Asigna estos valores a los campos en el segundo modal
        $('#idclienteEditar').val(idcliente);
        $('#apellidocliEditar').val(apellidocli);
        $('#nombrecliEditar').val(nombrecli);
        $('#dnicliEditar').val(dnicli);
        $('#nacimientocliEditar').val(nacimientocli);
        $('#direccioncliEditar').val(direccioncli);
        $('#telefonocliEditar').val(telefonocli);
        $('#emailcliEditar').val(emailcli);
        $('#registrocliEditar').val(registrocli);
        
        // Cierra el primer modal (opcional)
        $('#myModal').modal('hide');
        
        // Abre el modal de edición
        $('#modalEditar').modal('show');
    }); 

});
</script>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table  id="mytable" border="1" width="100%" class="table table-striped display responsive nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Apellido</th>
                                <th>Nombre</th>
                                <th>DNI</th>
                                <th>Edad</th>
                                <th>Telefono</th>
                                <th></th>
                            </tr>
                        </thead>
                        <!--FOREACH-->
                        <?php
                        $idfila = 0;
                        foreach ($clienteDAO->seleccionar() as $k=>$d){
                            $idfila++;
                            //DATOS DE SERVICIO
                            $id = $d->getIdcliente();
                            $ape = $d->getApellido_cli();
                            $nom = $d->getNombre_cli();
                            $dni = $d->getDni_cli();
                            $nac = date("d/m/Y", strtotime($d->getNacimiento_cli()));
                            $actual = date("Y-m-d");
                            $edad = date_diff(date_create($d->getNacimiento_cli()), date_create($actual))->y;
                            $direc = $d->getDireccion_cli();
                            $tel = $d->getTelefono_cli();
                            $correo = $d->getCorreo_cli();
                            $registro = date("d/m/Y", strtotime($d->getRegistro_cli()));
                        ?>
                        <tr data-idfila="<?=$idfila?>"
                            data-idcliente="<?=$id?>"
                            data-apellidocli="<?=$ape?>"
                            data-nombrecli="<?=$nom?>"
                            data-dnicli="<?=$dni?>"
                            data-nacimientocli="<?=$nac?>"
                            data-direccioncli="<?=$direc?>"
                            data-emailcli="<?=$correo?>"
                            data-registrocli="<?=$registro?>"
                            data-telefonocli="<?=$tel?>" >
                            <td><?=$id?></td>
                            <td><?=$ape?></td>
                            <td><?=$nom?></td>
                            <td><?=$dni?></td>
                            <td><?=$edad?> Años</td>
                            <td><?=$tel?></td>
                            <td>
                                <button class="btn btn-primary ver-detalles" type="button">Detalles</button>
                            </td>
                        </tr>           

                        <?php    
                        }
                        ?>
                    </table>
                     <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-title">
                            <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Datos del Ciente</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="input-group mb-3">
                                        <label style="flex-basis: 40%" class="input-group-text">IDCLIENTE:</label>
                                        <input style="flex-basis: 60%" type="text" class="form-control" id="idcliente" value="" readonly="">
                                    </div>
                                    <div class="input-group mb-3">
                                      <label style="flex-basis: 40%" class="input-group-text">Apellido:</label>
                                      <input style="flex-basis: 60%" type="text" class="form-control" id="apellidocli" value="" readonly="">
                                    </div>
                                    <div class="input-group mb-3">
                                      <label style="flex-basis: 40%" class="input-group-text">Nombre:</label>
                                      <input style="flex-basis: 60%" type="text" class="form-control" id="nombrecli" value="" readonly="">
                                    </div>
                                    <div class="input-group mb-3">
                                      <label style="flex-basis: 40%" class="input-group-text">DNI:</label>
                                      <input style="flex-basis: 60%" type="text" class="form-control" id="dnicli" value="" readonly="">
                                    </div>
                                    <div class="input-group mb-3">
                                      <label style="flex-basis: 40%" class="input-group-text">Fecha de Nacimiento:</label>
                                      <input style="flex-basis: 60%" type="text" class="form-control" id="nacimientocli" value="" readonly="">
                                    </div>
                                    <div class="input-group mb-3">
                                      <label style="flex-basis: 40%" class="input-group-text">Dirección:</label>
                                      <input style="flex-basis: 60%" type="text" class="form-control" id="direccioncli" value="" readonly="">
                                    </div>
                                    <div class="input-group mb-3">
                                      <label style="flex-basis: 40%" class="input-group-text">Telefono:</label>
                                      <input style="flex-basis: 60%" type="text" class="form-control" id="telefonocli" value="" readonly="">
                                    </div>
                                    <div class="input-group mb-3">
                                      <label style="flex-basis: 40%" class="input-group-text">Email:</label>
                                      <input style="flex-basis: 60%" type="text" class="form-control" id="emailcli" value="" readonly="">
                                    </div>
                                    <div class="input-group mb-3">
                                      <label style="flex-basis: 40%" class="input-group-text">Fecha de Registro:</label>
                                      <input style="flex-basis: 60%" type="text" class="form-control" id="registrocli" value="" readonly="">
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="btnEditar">Editar</button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-title">
                            <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Cliente</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../Procesos/p_cliente.php?data=<?=$encoded_data?>&idcliente=<?=$id?>&accion=update" method="Post" enctype="multipart/form-data">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="input-group mb-3">
                                            <label style="flex-basis: 40%" class="input-group-text">IDCLIENTE:</label>
                                            <input style="flex-basis: 60%" type="text" class="form-control" id="idclienteEditar" name="apellido_cli" value="" readonly="">
                                        </div>
                                        <div class="input-group mb-3">
                                            <label style="flex-basis: 40%" class="input-group-text">Apellido:</label>
                                            <input style="flex-basis: 60%" type="text" class="form-control" id="apellidocliEditar" name="apellido_cli" value="">
                                        </div>
                                        <div class="input-group mb-3">
                                            <label style="flex-basis: 40%" class="input-group-text">Nombre:</label>
                                            <input style="flex-basis: 60%" type="text" class="form-control" id="nombrecliEditar" name="nombre_cli" value="">
                                        </div>
                                        <div class="input-group mb-3">
                                            <label style="flex-basis: 40%" class="input-group-text">DNI:</label>
                                            <input style="flex-basis: 60%" type="text" class="form-control" id="dnicliEditar" name="dni_cli" value="">
                                        </div>
                                        <div class="input-group mb-3">
                                            <label style="flex-basis: 40%" class="input-group-text">Fecha de Nacimiento:</label>
                                            <input style="flex-basis: 60%" type="text" class="form-control" id="nacimientocliEditar" name="nacimiento_cli" value="">
                                        </div>
                                        <div class="input-group mb-3">
                                            <label style="flex-basis: 40%" class="input-group-text">Dirección:</label>
                                            <input style="flex-basis: 60%" type="text" class="form-control" id="direccioncliEditar" name="direccion_cli" value="">
                                        </div>
                                        <div class="input-group mb-3">
                                            <label style="flex-basis: 40%" class="input-group-text">Telefono:</label>
                                            <input style="flex-basis: 60%" type="text" class="form-control" id="telefonocliEditar" name="telefono_cli" value="">
                                        </div>
                                        <div class="input-group mb-3">
                                            <label style="flex-basis: 40%" class="input-group-text">Email:</label>
                                            <input style="flex-basis: 60%" type="email" class="form-control" id="emailcliEditar" name="email_cli" value="">
                                        </div>
                                        <div class="input-group mb-3">
                                            <label style="flex-basis: 40%" class="input-group-text">F. Registros:</label>
                                            <input style="flex-basis: 60%" type="email" class="form-control" id="registrocliEditar" name="email_cli" value="">
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Editar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
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
