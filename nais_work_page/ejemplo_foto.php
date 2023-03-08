<?php
include_once('conexBD.php');
//error_reporting(E_ALL ^ E_NOTICE);
if (isset($_POST['enviat'])) $sele=$_POST['enviat'];
else $sele="0";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/practica1.css">
    <title>Foto Alumno</title>
</head>
<body>
<?php
if ($sele=="0") 
{	
    $sql="SELECT * FROM talumno;";
    $resultado = mysqli_query($conexion, $sql);
    $numderows = mysqli_num_rows($resultado);
?>
    <table id="tableAlumno">
    <tr>
        <th>Foto</th>
        <th>ID</th>
        <th>Nom</th>
        <th>Edad</th>
        <th>Observaciones</th>
        <th>Actualizar foto</th>
    </tr>
    <?php
    if ($numderows > 0) {
        while($row = mysqli_fetch_assoc($resultado)) {
    ?>
    <tr>
        <td><img src="foto_a/<?php if($row["Foto"]!=null){echo $row["Foto"];} else echo "user.png";?>">
        <form name="f1" action="alumne_foto.php" method="post" enctype="multipart/form-data">
        <input type="file" name="imagen" accept="image/*"></td>
        <td><?php echo $row["ID"]?></td>
        <td><?php echo $row["Nombre"]?></td>
        <td><?php echo $row["edad"]?></td>
        <td><?php echo $row["observacions"]?></td>
        <td>
            <input name="ID" type="hidden" value='<?php echo $row["ID"]?>' />
            <input name="enviat" type="hidden" value="1" />
            <input name="Enviar" type="submit" value="modificar" />        
            <input type=submit name="delete" value="delete" >
            <input type=hidden name="accion" value="delete">
            <input type=hidden name="id_alumno" value=<?php echo $row["ID"]?>>
        </form>
        </td>
    </tr>
<?php
        }
?>
    </table>
<?php
    } else {
        echo "<h3>0 filas</h3>";
    }
} else if ($_POST["delete"] == "delete"){
    $sql="SELECT Foto FROM talumno WHERE ID=".$_POST['id_alumno'].";";
    $resultado = mysqli_query($conexion, $sql);
    $numderows = mysqli_num_rows($resultado);
    $row = mysqli_fetch_assoc($resultado);

    echo $sql;
    $foto_name = $row["Foto"];
    echo $foto_name;
    $carpeta = $_SERVER['DOCUMENT_ROOT'].'/Practica2/foto_a/';
    if ($foto_name != "user.jpg"){
        if (!unlink($carpeta.$foto_name)) {
            echo ("$foto_name cannot be deleted due to an error");
        }
        else {
            echo ("$foto_name has been deleted");
        }
        $sqldelete="UPDATE talumno SET Foto='user.jpg' WHERE ID=".$_POST['ID'].";";
    }
    $resultado = mysqli_query($conexion, $sqldelete);
    echo "<h1><a href='alumne_foto.php'>consultar</a></h1>";
} else {
    //Extraemos el DNI de la BBDD
    $sql="SELECT dni FROM talumno WHERE ID=".$_POST['ID'].";";
    $resultado = mysqli_query($conexion, $sql);
    $numderows = mysqli_num_rows($resultado);
    $row = mysqli_fetch_assoc($resultado);

    //Recibimos la imagen del formulario
    $nombre_img = $_FILES['imagen']['name'];
    $new_name = $row["dni"].".jpg";
    $tipo_imagen = $_FILES['imagen']['type'];
    $size_image = $_FILES['imagen']['size'];
    $carpeta = $_SERVER['DOCUMENT_ROOT'].'/Practica2/foto_a/';

    //Movemos la imagen a la carpeta de destino
    if(isset($_FILES["imagen"])) {
        $file_size = 200;
        if(($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg") 
        && $size_image <= ($file_size * 1024)){
            if (file_exists($carpeta.$nombre_img)){
                echo "El archivo ya existe";
            } else {
                move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$new_name);
                //rename ($carpeta.$nombre_img, $carpeta.$new_name);
                echo "El archivo ha sido guardado correctamente";
            }
        } else {
            echo "No es una imagen o excede el tamaño aceptado. <br>";
        }
    } else {
        echo "el achivo no existe.";
    }
    $sql="UPDATE talumno SET Foto='".$new_name."' WHERE ID=".$_POST['ID'].";";
    echo "<br>".$sql."<br>";
    $resultado = mysqli_query($conexion, $sql);
    echo "<h1><a href='alumne_foto.php'>consultar</a></h1>";
    mysqli_close($conexion);
}
?>
</body>
</html>