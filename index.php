<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>CareVet Veterinaria</title>
    </head>
    <body>
        <?php
        require_once __DIR__ . '/vendor/autoload.php';

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        echo "<script>window.location.href='./Vista/login.php';</script>"
        ?>
    </body>
</html>
