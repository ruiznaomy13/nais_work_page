<?php include_once('conexBD.php');?>
<html><head> <title>INDEX</title></head>
<body>

    <h1>Insertar</h1>

<?php
/*
$sql="INSERT INTO tusuario (numero_telefono, codigo_postal, nom_usuario, contrasenya, tipo, DNI, ID, correo) 
VALUES ('697845721', '08042', 'Brad Darwin', 'bradDarwin', '2', '56899123R', NULL, 'bradar20@yahoo.com')";
*/



$telefono="65838392929";
$codigo="08042"
$nombre='David';
$contrasenya="qwerty";
$tipo=1;
$dni="45355644656x";
$correo='dpascua5@ilg.cat';

$sql="INSERT INTO tusuario (numero_telefono, codigo_postal, nom_usuario, contrasenya, tipo, DNI, ID, correo) 
VALUES ('697845721', '08042', '" . $nombre . "' , 'bradDarwin', '2', '56899123R', NULL, 'truño@hotmail.com')";

echo $sql;

echo "¿qué es esto?:" . $sql;

  if (mysqli_query($conexion, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
  }



?>

</body></html>