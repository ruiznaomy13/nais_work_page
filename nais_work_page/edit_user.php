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
  <title>NAIS</title>
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
                  <li><a href="user.php" id="selected">USERS</a></li>
                  <li><a href="proteins.php">PROTEINS</a></li>
                  <li><a href="drugs.php">PHARMACS</a></li>
                  <li><a href="login.php">LOG IN</a></li>
                </ul>
            </nav>

        </div>
    </div>
</header>
<script src="js/script.js"></script>
<?php
if ($sele=="0") 
{
$sql="SELECT * FROM tusuario WHERE ID=".$_GET['id_user'].";";

$resultado = mysqli_query($conexion, $sql);

$numderows = mysqli_num_rows($resultado);

if ($numderows > 0) {
  while($row = mysqli_fetch_assoc($resultado)) {

?>
<div class="container-title">EDIT USER</div>
  <main>
    <div class="container-img">
      <img src="img/<?php echo $row["foto"]?>" alt="medicamento 1"/>
    </div>
    <div class="container-info-med">
      <div class="container-table">
      <form action="edit_user.php" method="post" name="formu">
        <table>
        <tr>
            <td id="column1">ID: </td>
            <td><?php echo $row["ID"]?></td>
          </tr>
          <tr>
            <td id="column1">Name: </td>
            <td><input type="text" name="name" value='<?php echo $row["nom_usuario"]?>'></td>
          </tr>
          <tr>
            <td id="column1">Email:</td>
            <td><input type="text" name="email" value='<?php echo $row["correo"]?>'></td>
          </tr>
          <tr>
            <td id="column1">DNI:</td>
            <td><input type="text" name="dni" value='<?php echo $row["DNI"]?>'></td>
          </tr>
          <tr>
            <td id="column1">Phone number: </td>
            <td><input type="text" name="phone" value='<?php echo $row["numero_telefono"]?>'></td>
          </tr>
          <tr>
            <td id="column1">Postal code:</td>
            <td><input type="text "name="postal_code" value='<?php echo $row["codigo_postal"]?>'></input>
            </td>
          </tr>
          <tr>
            <td id="column1">Password:</td>
            <td><input type="text" name="pass" value='<?php echo $row["contrasenya"]?>'></input>
            </td>
          </tr>
          <tr>
            <td id="column1">User type:</td>
            <td><input type="text" name="type" value='<?php echo $row["tipo"]?>'></input>
            </td>
          </tr>
        </table>
        <input name="ID" type="hidden" value='<?php echo $row["ID"]?>' />
        <input name="enviat" type="hidden" value="1" />
        <input name="Enviar" type="submit" value="modificar" />
    </form>
  </main>
<?php
    }
}
else 
{
  echo "<h3>0 filas</h3>";
  echo "<h3><a href='index.php'>INDEX</a></h3>";	
}

} 
else 
{
  $sql="UPDATE tusuario SET nom_usuario='".$_POST['name']."',correo='".$_POST['email']."',DNI='".$_POST['dni']."',
  numero_telefono=".$_POST['phone'].",codigo_postal='".$_POST['postal_code']."',contrasenya='".$_POST['pass']."' 
  WHERE ID=".$_POST['ID'].";";

echo "<br>".$sql."<br>";
$resultado = mysqli_query($conexion, $sql);
mysqli_close($conexion);
echo "<br>LLISTAT<br>";
echo "<h1><a href='user.php'>consultar</a></h1>";
//header('Location: user.php');
}
?>
      </div>
    </div>
  </main>
</body>
</html>