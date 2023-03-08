<?php
include_once('php/conexBD.php');

if(!empty($_POST['nom'])){
    $sqlss="SELECT MAX(codigo) as codigo_maximo FROM tproteinas";
    $ss=mysqli_query($conexion,$sqlss);
    if($rr=mysqli_fetch_array($ss)){
        $codigo_maximo=$rr['codigo_maximo'];
    }
    
    $img_name=$_FILES['imagen']['name'];
    $tmpimg=$_FILES['imagen']['tmp_name'];
    $foto_name="proteina".$codigo_maximo.".jpg";
    $carpeta="img/proteinas/".$foto_name;
    if(is_uploaded_file($tmpimg)){
        copy($tmpimg,$carpeta);
        echo 'Imagen subida con exito';
        $sql="INSERT INTO tproteinas(resolucion,metodo,nombre,foto,fecha,especie,tipo_fichero,nombre_fichero,id_creador) 
        VALUES ('".$_POST['resolucion']."','".$_POST['metodo']."','".$_POST['nom']."','$foto_name','".$_POST['fecha']."','".$_POST['especie']."','".$_POST['tipo_f']."','".$_POST['nom_f']."','".$_POST['id_creador']."');";
        mysqli_query($conexion,$sql);
    } else {
        echo 'UPS! Algo ha fallado al subir la imagen';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New protein</title>
</head>

<body>
    <form name="form" action="" method="post" enctype="multipart/form-data">
    <table>
          <div id="column1">
            <tr>
                <td>Seleccionar imagen</td>
                <td><input type="file" name="imagen" id="imagen"></td>
            </tr>
            <tr>
              <td>Name: </td>
              <td><input name="nom" type="text" value="" required/></td>
            </tr>
            <tr>
                <td>Resolution:</td>
                <td><input name="resolucion" type="text"  required/></td>
            </tr>
            <tr>
              <td>Method: </td>
              <td><input name="metodo" type="text"  required/></td>
            </tr>
            <tr>
                <td>Date:</td><td><input name="fecha" type="date"/></td>
            </tr>
            <tr>
                <td>File type:</td><td><input name="tipo_f" type="text" required/></td>
            </tr>
            <tr>
                <td>File name:</td><td><input name="nom_f" type="text"  required/></td>
            </tr>
            <tr>
                <td>Spicies:</td><td><input name="especie" type="text" required/></td>
            </tr>
            <tr>
                <td>Creator:</td><td><input name="id_creador" type="text" /></td>
            </tr>
          </div>
        </table>
        <button type="submit">Save</button>
    </form>
</body>

</html>