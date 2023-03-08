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
                    <li><a href="user.php">USERS</a></li>
                    <li><a href="proteins.php">PROTEINS</a></li>
                    <li><a href="drugs.php"  id="selected">PHARMACS</a></li>
                    <li><a href="login.php">LOG IN</a></li>
                </ul>
            </nav>

        </div>
    </div>
</header>


<script src="js/script.js"></script>

  <div class="container-title">CREATE NEW USER </div>
      <?php
        if ($sele=="0")
        {
      ?>

  <main>
    <div class="container-img">
      <form action="new_drug.php" method="post" name="formu" enctype="multipart/form-data">
      <div class="hover_img">
        <!-- <div class="edit-img">Upload photo</div> -->
        <input type="file" name="imagen" id="imagen">
      </div>
    </div>

    <div class="container-info-med">
      <div class="container-table">
        <table>
          <div id="column1">
            <tr>
                <td>Inchi:</td><td><input name="inchi" type="text"  value="" required></td>
            </tr>
            <tr>
                <td>State:</td><td><input name="estado" type="text"  required/></td>
            </tr>
            <tr>
              <td>Name: </td><td><input name="nom" type="text" value="" required/></td>
            </tr>
            <tr>
              <td>Description: </td>
              <td><textarea name="descript" type="text" value=""></textarea></td>
            </tr>
            <tr>
                <td>Date:</td><td><input name="date" type="date"/></td>
            </tr>
            <tr>
                <td>File type:</td><td><input name="tipo_f" type="text" required/></td>
            </tr>
            <tr>
                <td>File name:</td><td><input name="nom_f" type="text"  required/></td>
            </tr>
            <tr>
                <td>Smiles:</td><td><input name="smiles" type="text" required/></td>
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
      $sqlss="SELECT MAX(codigo) as codigo_maximo FROM tfarmacos";
      $ss=mysqli_query($conexion,$sqlss);
      if($rr=mysqli_fetch_array($ss)){
          $codigo_maximo=$rr['codigo_maximo'];
      }
      
      $img_name=$_FILES['imagen']['name'];
      $tmpimg=$_FILES['imagen']['tmp_name'];
      $foto_name="medicamento".$codigo_maximo.".jpg";
      $carpeta="img/medicamentos/".$foto_name;
      if(is_uploaded_file($tmpimg)){
          copy($tmpimg,$carpeta);
          echo 'Imagen subida con exito';
          $sql="INSERT INTO tfarmacos(inchi,estado,nombre,foto,descripcion,fecha,tipo_fichero,nombre_fichero,smiles,id_creador) 
          VALUES ('".$_POST['inchi']."','".$_POST['estado']."','".$_POST['nom']."','$foto_name','".$_POST['descript']."','".$_POST['date']."','".$_POST['tipo_f']."','".$_POST['nom_f']."','".$_POST['smiles']."','".$_POST['id_creador']."');";
          mysqli_query($conexion,$sql);

      } else {
          echo 'UPS! Algo ha fallado al subir la imagen';
      }
  }
    echo "<h1><a href='drugs.php'>consultar</a></h1>";
    //header('Location: drugs.php');
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