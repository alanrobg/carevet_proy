<!DOCTYPE html>

<!--
Proyecto CareVet Veterinaria
-->

<?php

//---------------------------------------------------------------
//Administra codigos de errores
$error = "";

//---------------------------------------------------------------
?>
<html>
<head>
    <meta charset="utf-8">
    <title>CareVet Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="recursos/estilo.css" rel="stylesheet" type="text/css"/>
</head>

<body>
        <div>
            <br><br><br><br>
        </div>
        <div class="container">
        <h1>Inicio de sesión</h1>
        <form action="Procesos/p_usuario.php" method="post">
          <div class="form-group">
            <label for="Name">Usuario</label>
            <input type="text" class="form-control" id="Name" placeholder="Usuario" name="usuario_usu">
          </div>
          <div class="form-group">
            <label for="Password">Contraseña</label>
            <input type="password" class="form-control" id="Password" placeholder="Contraseña" name="password_usu">
          </div>  

            <input type="submit" class="btn btn-primary" value="Ingresar">
        </form>
        </div>
        <?php
        //
        if(isset($_GET['error'])){
           echo $error;
        }
        ?>
    
    
</body>
</html>
