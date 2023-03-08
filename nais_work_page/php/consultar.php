<?php include_once('conexBD.php');?>
<html><head> <title>INDEX</title></head>
<body>

    <h1>Consultar</h1>

<?php
$sqlusuario="SELECT * FROM tusuario";
$resultado= mysqli_query($conexion, $sqlusuario);
if (mysqli_num_rows($resultado) > 0) {
    while($row = mysqli_fetch_assoc($resultado)) {
        echo "<h4>" . $row["ID"]. "->  Name: " . $row["nom_usuario"].
        ",  Correo: " . $row["correo"]. ",  Contraseña " . $row["contrasenya"].",  
        tipo: " . $row["tipo"].", DNI: " . $row["DNI"].",  CP: " . $row["codigo_postal"]."
         ,Telefono: " . $row["numero_telefono"].
        "</h4>";
    }
} else echo "0 filas";


$sqlfarmac="SELECT * FROM tfarmacos";
$resultado= mysqli_query($conexion, $sqlfarmac);
if (mysqli_num_rows($resultado) > 0) {
    while($row = mysqli_fetch_assoc($resultado)) {
        echo "<h4>" . $row["id_creador"]. "->  Name: " . $row["nombre"].
        ",  Inchi: " . $row["inchi"]. ",  Estado: " . $row["estado"].",  
        Codigo: " . $row["codigo"].", Fecha: " . $row["fecha"].",  Tipo fichero: " . $row["tipo_fichero"]."
         , Nombre fichero: " . $row["nombre_fichero"].", Smmiles: " . $row["smiles"].
        "</h4>";
    }
} else echo "0 filas";

// $sqlusuario="INSERT INTO `tusuario` (`numero_telefono`, `codigo_postal`, `nom_usuario`, `contrasenya`, `tipo`, `DNI`,  `correo`) 
// VALUES ('697845721', '08042', 'Brad Darwin', 'bradDarwin', '1', '56899123R' , 'bradar20@yahoo.com');"
// $resultado= mysqli_query($conexion, $sqlusuario);
?>

</body></html>