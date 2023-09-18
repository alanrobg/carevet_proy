<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../recursos/datatable.css" rel="stylesheet" type="text/css"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css'>


    <title>Carevet</title>
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

<body>
    <div class="container my-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#newcliente">Nuevo Cliente</button>
                
                <button id="btnActualizar" class="btn btn-primary">Actualizar</button>
                
                
                <table id="data_table" class="table table-striped display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="centered">idcliente</th>
                            <th class="centered">apellido</th>
                            <th class="centered">nombre</th>
                            <th class="centered">dni</th>
                            <th class="centered">F. Nacimiento</th>
                            <th class="centered">Direccion</th>
                            <th class="centered">telefono</th>
                        </tr>
                    </thead>
                    <tbody id="table_service"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newcliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-title">
        <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Cliente</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formulario1" method="Post" enctype="multipart/form-data">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Apellido:</label>
                      <input style="flex-basis: 60%" type="text" class="form-control" name="apellido_cli" value="">
                    </div>
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Nombre:</label>
                      <input style="flex-basis: 60%" type="text" class="form-control" name="nombre_cli" value="">
                    </div>
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">DNI:</label>
                      <input style="flex-basis: 60%" type="text" class="form-control" name="dni_cli" value="">
                    </div>
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Fecha de Nacimiento:</label>
                      <input style="flex-basis: 60%" type="date" class="form-control" name="nacimiento_cli" value="">
                    </div>
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Dirección:</label>
                      <input style="flex-basis: 60%" type="text" class="form-control" name="direccion_cli" value="">
                    </div>
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Telefono:</label>
                      <input style="flex-basis: 60%" type="text" class="form-control" name="telefono_cli" value="">
                    </div>
                    <div class="input-group mb-3">
                      <label style="flex-basis: 40%" class="input-group-text">Correo:</label>
                      <input style="flex-basis: 60%" type="text" class="form-control" name="correo_cli" value="">
                    </div>
                    <input type="text" name="idusuario" value="1" hidden="">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btnAgregar">Agregar</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
<script src="main.js"></script>

<script src="new_cliente.js"></script>

</body>
</html>