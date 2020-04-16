<?php
    session_start();
    include("cer.php");
    $cer = new Certificados();
    
    $tipo = $cer->getTipo();

    if (!isset($_SESSION["id"]))
    {
        header("Location: login.php");
    }
   
    
    if (isset($_POST["cedula"])){
      
      $cedula = $_POST["cedula"];
      $nombre = $_POST["nombre"];
      $apellido = $_POST["apellido"];
      $correo = $_POST["correo"];
      $id = $_POST["id"];
      $tipo = $_POST["tipo"];
      $cer->setCertificados($cedula, $nombre, $apellido, $correo, $tipo, $id);
  }
  else
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
    <script
              src="https://code.jquery.com/jquery-3.3.1.min.js"
              integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
              crossorigin="anonymous"></script>
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
<script>
  function atras()
  {
    window.location="panel.php";
  }
</script>
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
<?php
  if (isset($_GET["resp"]) and $_GET["resp"] == 1){
?>
<div id="mess" class="alert alert-success" role="alert">
  El dato fue agregado satisfactorimente
</div>
<?php
  }else if (isset($_GET["resp"]) and $_GET["resp"] == 2){
?>
<div id="mess" class="alert alert-danger" role="alert">
  Hubo un error al momento de agregar los datos. Consulte con su administrador
</div>
<?php
  }
?>
<br>
<form method="POST" enctype="multipart/form-data" action="pe.php">
<div class="row cuerpo">
  <div class="col-md-12">
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

  <div class="form-group">
    <label for="tipo">Tipo</label>
    <select name="tipo" id="tipo" require class="form-control" required>
      <option value="">Seleccione una opción</option>
    <?php
    foreach ($tipo as $key => $value)
    {
    ?>
    <option value="<?php echo $value["id"]; ?>"><?php echo $value["nombre"]; ?></option>
    <?php 
    } 
    ?>
    </select>
  </div>
  <input type="hidden" name="id" value="<?php echo $_GET["id"]?>">
  <input type="button" value="Atrás" onclick="atras()" class="btn btn-info" />
  <button type="submit" class="btn btn-success">Enviar</button>
  
  </div>
  </form>
</div>
<script>
$(document).ready(function(){
    setTimeout(function() {
          $('#mess').fadeOut('fast');
    }, 3000); // <-- time in milliseconds
});
</script>

</body>
</html>