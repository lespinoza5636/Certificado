<?php
    session_start();
    //echo php_ini_loaded_file();
    include("cer.php");
    $cer = new Certificados();
    
    $tipo = $cer->getTipo();

    if (!isset($_SESSION["id"]))
    {
        header("Location: login.php");
    }

    if (isset($_FILES['myfile'])) {

      $file = $_FILES["myfile"];
      $tipo = $_POST["tipo"];
      $id = $_POST["id"];

      $cer->setModelo($file, $tipo, $id);
    }
  else
  if (!isset($_GET["id"]))
  {
    echo isset($_FILES['myfile']);
    print_r($_FILES['myfile']);
    print_r($_POST["tipo"]);
    print_r($_POST["id"]);
    print_r($_POST);
    exit();
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
<br>
<form method="POST" enctype="multipart/form-data" action="modelo.php">
<div class="row cuerpo">
  <div class="col-md-12">
  <h2>Modelo de certificado por tipo de participantes </h2><hr />
  <div class="form-group">
    <label for="myfile">Modelo</label>
    <input type="file" required class="form-control" id="myfile" name="myfile" placeholder="Ingrese el modelo">
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
<br>
<div class="row">
<div class="col-md-12">
<h2>Modelos</h2>
</div>

</div>

</body>
</html>