<?php
  include_once('php/conexBD.php');
  //error_reporting(E_ALL ^ E_NOTICE);
  if (isset($_POST['enviat'])) $sele=$_POST['enviat'];
  else $sele="0";
?>
<!DOCTYPE html>
<html>
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

  <div class="container-title">CREATE NEW USER </div>

  <main>



    <div class="container-img">
      <div class="hover_img">
        <div class="edit-img">Upload photo</div>
      </div>
    </div>

    <div class="container-info-med">
      <div class="container-table">
      <?php
        if ($sele=="0")
        {
      ?>
      <form action="new_user.php" method="post" name="formu">
        <table>
          <div id="column1">
            <tr>
              <td>nombre: </td><td><input name="nom" type="text" value="" required/></td>
            </tr>
            <tr>
                <td>Correo:</td><td><input name="correo" type="text"  value="" required></td>
            </tr>
            <tr>
                <td>Contraseña:</td><td><input name="contrasenya" type="password"  required/></td>
            </tr>
            <tr>
                <td>Tipo:</td><td><input name="tipo" type="text"  required/></td>
            </tr>
            <tr>
                <td>DNI:</td><td><input name="dni" type="text"  minlength=8 maxlength=9 required/></td>
            </tr>
            <tr>
                <td>CP:</td><td><input name="cp" type="text" /></td>
            </tr>
            <tr>
                <td>Telefono:</td><td><input name="telefono" type="number" /></td>
            </tr>
          </div>
        </table>
        <input class="btn" name="enviat" type="hidden" value="1"/>
        <input class="btn" name="Enviar" type="submit" value="inserir" />
        <input class="btn" name="Enviar" type="reset" value="reset" />
      </form>
    </div>
  </main>
  <br>
  <div class="input_field">
  </div>
  <?php
  } 
  else 
  {

    if (isset($_POST['nom'])) 
    $sql="INSERT INTO tusuario(numero_telefono,codigo_postal,nom_usuario,contrasenya,tipo,DNI,correo) VALUES ('".$_POST['telefono']."',".$_POST['cp'].",'".$_POST['nom']."','".$_POST['contrasenya']."','".$_POST['tipo']."','".$_POST['dni']."','".$_POST['correo']."');";

    echo "<br>".$sql."<br>";
    $resultado = mysqli_query($conexion, $sql);
    echo "<br>LLISTAT<br>";
    echo "<h1><a href='user.php'>consultar</a></h1>";
  }
  
  mysqli_close($conexion);
  ?>

 <!-- <footer class="pie-pagina">
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
</footer> -->
</body>

</html>