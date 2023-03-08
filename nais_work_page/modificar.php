<?php
include_once('php/conexBD.php');
//error_reporting(E_ALL ^ E_NOTICE);
if (isset($_POST['enviat'])) $sele=$_POST['enviat'];
else $sele="0";
?>
<!DOCTYPE HTML>
<html LANG="es"><head><meta charset="UTF-8"><title>Modificar docente</title></head>
<body>
<?php
if ($sele=="0") 
{	
$sql="SELECT * FROM tusuario WHERE ID LIKE '3';";

$resultado = mysqli_query($conexion, $sql);

$numderows = mysqli_num_rows($resultado);

if ($numderows > 0) {
  while($row = mysqli_fetch_assoc($resultado)) {

    ?>

<form action="modificar.php" method="post" name="formu">
<table border="1">
<tr>
<td>nombre: </td><td><input name="nom" type="text" value='<?php echo $row["nom_usuario"]?>' required/></td>
</tr>
<tr>
<td>telefono:</td><td><input name="telef" type="number" value='<?php echo $row["DNI"]?>' minlength=9 maxlength=9/></td>
</tr>
</table>
<input name="iddocente" type="hidden" value='<?php echo $row["ID"]?>' />
<input name="enviat" type="hidden" value="1" />
<input name="Enviar" type="submit" value="modificar" />
</form>
<?php 

  }
  echo "<h3>numero de filas-> ".$numderows."</h3>";
} 
else 
{
  echo "<h3>0 filas</h3>";
  echo "<h3><a href='index.php'>INDEX</a></h3>";	
}

} 
else 
{
if ($_POST['telef']=="") $sql="UPDATE tusuario SET nombre='".$_POST['nom']."',telefono=null WHERE ID=".$_POST['ID'].";";
else $sql="UPDATE tusuario SET nombre='".$_POST['nom']."',telefono=".$_POST['telef']." WHERE ID=".$_POST['ID'].";";

echo "<br>".$sql."<br>";
$resultado = mysqli_query($conexion, $sql);
mysqli_close($conexion);
echo "<br>LLISTAT<br>";
echo "<h1><a href='consultardocente.php'>consultar</a></h1>";
}

?>
</body>
</html>
