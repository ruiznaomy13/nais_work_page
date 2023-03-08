<?php
$host = "localhost";
$database = "bbddnais";
$user = "ncastell";
$password = "98901403";
$conexion = mysqli_connect($host, $user, $password,$database);

if (!$conexion) die("No ha podido realizarse la conexión".mysqli_connect_error());
 //cierra la BBDD
 
?>