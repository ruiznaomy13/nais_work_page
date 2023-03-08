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
    <title>New protein</title>
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


<script src="js/script.js"></script>

  <?php
    if ($sele=="0")
    {
  ?>
  <div class="container-title">CREATE NEW PROTEIN </div>

  <main>
    <div class="container-img">
      <form action="new_protein.php" method="post" name="formu" enctype="multipart/form-data">
      <div class="hover_img">
        <input type="file" name="imagen" id="imagen">
        <!-- <div class="edit-img">Upload photo</div> -->
      </div>
    </div>

    <div class="container-info-med">
      <div class="container-table">
        <table>
          <div id="column1">
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
    echo "<h1><a href='proteins.php'>consultar</a></h1>";
    //header('Location: proteins.php');
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