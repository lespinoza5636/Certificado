<?php
    session_start();
    include("cer.php");
    
    if (!isset($_SESSION["id"]))
    {
        header("Location: login.php");
    }
    
    if (isset($_FILES['cer'])){
      $cer = new Certificados();
      $cedula = $_POST["cedula"];
      $nombre = $_POST["nombre"];
      $apellido = $_POST["apellido"];
      $correo = $_POST["correo"];
      $id = $_POST["id"];
      $cer->setCertificados($_FILES['cer'], $cedula, $nombre, $apellido, $correo, $id);
  } else{
      $nombre_archivo="";
  }
  if (!isset($_GET["id"]))
  {
    header("Location: panel.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
    <title>Certificado</title>

    <style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}
tr:hover {
          background-color:#f1f1f1;
        }

.cuerpo
{
    background: #ffffff;
    padding: 10px;
}
</style>
</head>
<body>

<div class="container">
<div class="row">
banner
</div>
<div class="row">
Menu
</div>
<br>
<br>
<form method="POST" enctype="multipart/form-data" action="pe.php">
<div class="row cuerpo">
  <div class="col-md-6">
  <h2>Datos del participante </h2><hr />
  <div class="form-group">
    <label for="cedula">Cédula</label>
    <input type="text" required class="form-control" id="cedula" name="cedula" placeholder="Ingrese la cédula" pattern="[0-9]{1, 13}[A-Z]{1}">
  </div>
  <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" required class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre">
  </div>
  <div class="form-group">
    <label for="apellido">Apellido</label>
    <input type="text" required class="form-control" id="apellido" name="apellido" placeholder="Ingrese el apellido">
  </div>
  <div class="form-group">
    <label for="correo">Correo</label>
    <input type="email" required class="form-control" id="correo" name="correo" placeholder="Ingrese el correo">
  </div>
  <button type="submit" class="btn btn-success">Enviar</button>

  </div>
  <div class="col-md-6">
  <div class="row">
  <div class="col-md-11">
  <h2>Certificado</h2><hr />
  </div>
  <div class="col-md-1">
    <a href="panel.php">
      <i class="fas fa-backward fa-2x"></i>
    </a>

  </div>
  </div>
  
  <div class="form-group">
    <label for="cer">Certificado</label>
    <input type="file" required class="form-control" id="cer" name="cer" placeholder="Ingrese el correo">
  </div>
  </div>
  <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
  </form>
</div>
</body>
</html>