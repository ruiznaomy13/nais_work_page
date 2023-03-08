<?php
include_once('php/conexBD.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UFT-8">
    <meta http-equiv="X-UA-Compatible" content="width=device-width,
    initial-scale=1.0">
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel=”stylesheet” href=”https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css”>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" 
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Proteinas</title>
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
                    <li><a href="proteins.php"  id="selected">PROTEINS</a></li>
                    <li><a href="drugs.php">PHARMACS</a></li>
                    <li><a href="login.php">LOG IN</a></li>
                </ul>
            </nav>

        </div>
    </div>
</header>


<?php
if(!isset($_GET["accion"]))
{
    $sql="SELECT * FROM tproteinas;";

    $resultado = mysqli_query($conexion, $sql);
    
    $numrows = mysqli_num_rows($resultado);
?>

<div class="titulo_drugs">
        <h2>Proteins</h2>
    </div>
    <br>

    <div class="container_grande_0">
        <div class="container_izquierda">
            <div class="resultados">
                <p>Nº RESULTADOS</p>
            </div>
        </div>
        <div class="container_derecha">
                <a style="color:black" class="box_farmacos" href="new_protein.php">CREATE NEW</a>
            <br>
            <div class="box_farmacos" style="cursor:pointer">
                <p>MY Proteins</p>
            </div>
        </div>
    </div>
    <br>
    <div class="container_grande">
        <div class="container_izquierda">
            <div class="filtrar">
                <p>ORDENAR POR:</p>
            </div>
            <br>
            <div class="filtrar">
                <p>FILTRO DE RESULTADOS:</p>
            </div>
        </div>

        <div class="container_derecha">

            <?php
            if ($numrows > 0) {
            while($row = mysqli_fetch_assoc($resultado)) {
            ?>
            <div class="drugs">
                <a href="">
                    <img src="img/proteinas/<?php echo $row["foto"]?>">
                </a>
                <div class="parrafo_drugs">
                    <h3><?php echo $row["nombre"]?></h3><br>
                    <h5>Resolution: <?php echo $row["resolucion"]?></h5>
                    <h5>Method: <?php echo $row["metodo"]?></h5>
                    <h5>Species: <?php echo $row["especie"]?></h5>
                </div>
            </div>
            
            <div class="container_botones">
            <form action="view_protein.php" method=get>
                <input type=submit class="botones" value="view">
                <input type=hidden name="accion" value=view>
                <input type=hidden name="code_protein" value=<?php echo $row["codigo"]?>>
            </form>
            <form action="edit_protein.php" method=get>
                    <input type=submit class="botones" value="edit">
                    <input type=hidden name="accion" value=edit>
                    <input type=hidden name="code_protein" value=<?php echo $row["codigo"]?>>
            </form>
            <form action="proteins.php" method=get>
                    <input type=submit class="botones" value="delete">
                    <input type=hidden name="accion" value=delete>
                    <input type=hidden name="code_protein" value=<?php echo $row["codigo"]?>>
            </form>  
            </div>
            
            <br>
            <br>
            <?php 
                }
            ?>
        </div>
        </table>
      </div>
    </div>
  </main>

    <?php
            }

}

else if ($_GET["accion"] == "delete")
{
    echo "<h1>Borramos cosas</h1>";
    $sql="DELETE FROM tproteinas WHERE codigo=".$_GET['code_protein'].";";
    $resultado = mysqli_query($conexion, $sql);
    echo "<h1><a href='proteins.php'>consultar</a></h1>";
    mysqli_close($conexion);

}



?>

<!--
<footer class="pie-pagina">

  <div class="grupo-1">

      <div class="box">
          <figure>
              <a href="#">
                  <img src="img/logo-1def.png" alt="Logo NAIS">
              </a>
          </figure>
      </div>

      <div class="box">
          <h2>INFORMACIÓN DE CONTACTO</h2>
          <p>UBICACIÓN: C/XXX XX XXXX</p>
          <p>TELÉFONO: XXX XX XX XX</p>
          <p>CORREO: XXXXXXX@XXXXXX</p>
      </div>

      <div class="box">
          <h2>NORMATIVA LEGAL</h2>
          <p>PROTECCIÓN DE DATOS</p>
          <p>POLÍTICA DE COOKIES</p>
          <p>AVISO LEGAL</p>
      </div>
  </div>

  <div class="grupo-2">
      <small>&copy; 2022 <b>NaIs</b> - Todos los Derechos Reservados.</small>
  </div>


</footer>
-->
</body>
</html>
