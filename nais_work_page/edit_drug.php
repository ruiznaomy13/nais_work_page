<?php
include_once('php/conexBD.php');
//error_reporting(E_ALL ^ E_NOTICE);
if (isset($_POST['enviat'])) $sele=$_POST['enviat'];
else $sele="0";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UFT-8">
  <meta http-equiv="X-UA-Compatible" content="width=device-width,
  initial-scale=1.0">
  <link rel="stylesheet" href="css/info_medicament_create.css">
  <link rel="stylesheet" href="css/estilo.css">
  <link rel=”stylesheet” href=”https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css”>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" 
  integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" 
  crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <title>Edit drug</title>
  <link rel="shorcut icon" type="image/png" href="img/favicon.png"> 
  <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <div class="container_menu">
        <div class="logo">
            <a href="index.html"><img src="img/logo-2def.png"></a>
        </div>

        <div class="menu">
            <i class="fas fa-bars" id="btn_menu"></i>
            <div id="back_menu"></div>
            <nav id="nav">
                <div id="logo2">
                    <a href="Nais.html"><img src="img/logo-2def.png"></a>
                </div>
                <ul>
                  <li><a href="index.html">HOMEPAGE</a></li>
                  <li><a href="statistics.html">STATISTICS</a></li>
                  <li><a href="user.php">USERS</a></li>
                  <li><a href="proteins.html">PROTEINS</a></li>
                  <li><a href="drugs.html" id="selected">PHARMACS</a></li>
                  <li><a href="login.html">LOG IN</a></li>
                </ul>
            </nav>

        </div>
    </div>
</header>
<?php
if ($sele=="0") 
{
$sql="SELECT * FROM tfarmacos WHERE codigo=".$_GET['code_drug'].";";

$resultado = mysqli_query($conexion, $sql);

$numderows = mysqli_num_rows($resultado);

if ($numderows > 0) {
  while($row = mysqli_fetch_assoc($resultado)) {
?>

<div class="container-title">EDIT DRUG</div>
<main>
    <div class="container-img">
      <img src="img/medicamentos/<?php echo $row["foto"]?>" alt="medicamento 1"/>
    </div>
    <div class="container-info-med">
    <div class="container-table">
    <form action="edit_drug.php" method="post" name="formu">
    <table>
        <tr>
            <td id="column1">ID: </td>
            <td><?php echo $row["codigo"]?></td>
        </tr>
        <tr>
            <td id="column1">Name: </td>
            <td><input type="text" name="name" value='<?php echo $row["nombre"]?>'></td>
        </tr>
        <tr>
            <td id="column1">Estado:</td>
            <td><input type="text" name="estado" value='<?php echo $row["estado"]?>'></td>
        </tr>
        <tr>
          <td id="column1">Inchi:</td>
          <td><input type="text" name="inchi" value='<?php echo $row["inchi"]?>'></td>
        </tr>
        <tr>
          <td id="column1">Date:</td>
          <td><input type="date" name="fecha" value='<?php echo $row["fecha"]?>'?></td>
        </tr>
        <tr>
            <td id="column1">File type: </td>
            <td><input type="text" name="f_type" value='<?php echo $row["tipo_fichero"]?>'></td>
        </tr>
        <tr>
            <td id="column1">File name:</td>
            <td><input type="text "name="f_name" value='<?php echo $row["nombre_fichero"]?>'></input>
            </td>
        </tr>
        <tr>
            <td id="column1">Smiles:</td>
            <td><input type="text" name="smiles" value='<?php echo $row["smiles"]?>'></input>
            </td>
        </tr>
        <tr>
            <td id="column1">Description:</td>
            <td><textarea type="text" name="descripcion"><?php echo $row["descripcion"]?></textarea></td>
        </tr>
        <!-- <tr>
            <td id="column1">Creador:</td>
            <td><input type="text" name="type" value='<?php echo $row["id_creador"]?>'></input>
            </td>
        </tr> -->
    </table>
        <input name="code" type="hidden" value='<?php echo $row["codigo"]?>' />
        <input name="enviat" type="hidden" value="1" />
        <input name="Enviar" type="submit" value="modificar" />
    </form>
  </main>
<?php
  }
} else {
    echo "<h3>0 filas</h3>";
}
} else {
    $sql="UPDATE tfarmacos SET nombre='".$_POST['name']."',estado='".$_POST['estado']."',inchi='".$_POST['inchi']."',
    fecha='".$_POST['fecha']."',tipo_fichero='".$_POST['f_type']."', nombre_fichero='".$_POST['f_name']."',
    smiles='".$_POST['smiles']."', descripcion='".$_POST['descripcion']."' WHERE codigo=".$_POST['code'].";";

/*    echo "<br><br><br><br><br>";
    echo $sql;
    echo "<br><br><br><br>";*/

    $resultado = mysqli_query($conexion, $sql);
    mysqli_close($conexion);

//     echo "<br>LLISTAT<br>";

    //    echo "<h1><a href='user.php'>consultar</a></h1>";
    header('Location: drugs.php');
}

?>
</body>
</html>