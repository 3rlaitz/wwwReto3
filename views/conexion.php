<?php
    $SERVIDOR = "localhost";
    $USUARIO = "root";
    $CONTRASENA = "";
    $BASE = "bdwwwreto";
    $CONEXION = @mysqli_connect($SERVIDOR, $USUARIO, $CONTRASENA, $BASE) or die("Fallo de conexión");
?>