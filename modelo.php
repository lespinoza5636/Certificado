<?php
    session_start();
    //echo php_ini_loaded_file();
    include("cer.php");
    $cer = new Certificados();
    
    $tipo = $cer->getTipo();
    $datos = $cer->getListaModelosDiplomas();

    if (isset($_GET["del"]))
    {
      
      $cert = $cer->funcionEliminar($_GET["del"], $_GET["img"]);
      $id = $_GET["id"];

      if ($cert == true)
      {
        echo "<script type='text/javascript'>window.location='modelo.php?d=1&id=$id';
        </script>";
      }
      else
      {
        echo "<script type='text/javascript'>window.location='modelo.php?d=2&id=$id';
        </script>";
      }
    }

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
    <script src="funciones.js"></script>
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
  <img src="imagenes/banner.png" alt="Smiley face" height="100%" width="100%">
</div>
<div class="row">

</div>
<br>

<?php
  if (isset($_GET["d"]) and $_GET["d"] == 1){
?>
<div id="mess" class="alert alert-success" role="alert">
  El dato fue eliminado satisfactorimente
</div>
<?php
  }else if (isset($_GET["d"]) and $_GET["d"] == 2){
?>
<div id="mess" class="alert alert-danger" role="alert">
  Hubo un error al momento de agregar los datos. Consulte con su administrador
</div>
<?php
}
?>



<?php
  if (isset($_GET["resp"]) and $_GET["resp"] == 1){
?>
<div id="mess" class="alert alert-success" role="alert">
  El tipo de certificado fue agregado satisfactorimente
</div>
<?php
  }else if (isset($_GET["resp"]) and $_GET["resp"] == 2){
?>
<div id="mess" class="alert alert-danger" role="alert">
  Hubo un error al momento de agregar los datos. Consulte con su administrador
</div>
<?php
}else if (isset($_GET["resp"]) and $_GET["resp"] == 3){
  ?>
  <div id="mess" class="alert alert-danger" role="alert">
  Hubo un error al momento de subir la imagen. Consulte con su administrador
  </div>
  <?php
  }else if (isset($_GET["resp"]) and $_GET["resp"] == 4){
    ?>
    <div id="mess" class="alert alert-danger" role="alert">
      El tipo de dato seleccionado, ya cuenta con un modelo de certificado
    </div>
    <?php
    }
?>


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
<table class="table">
  <thead class="thead-dark">
    <tr>
      
      <th scope="col">Certificado</th>
      <th scope="col">TIipo de Certificado</th>
      <th scope="col">  </th>
    </tr>
  </thead>
  <tbody>

  <?php 
  if ($datos != false)
  {
    

    foreach ($datos as $key => $value) {
  ?>
    
    <tr>
      
      <td><img src="cer/<?php echo $value["imagen"]; ?>.jpg" alt="No se encuentra la imagen" height="100px"></td>
      <td><?php echo $value["tipos"]; ?></td>
      <td><a href="modelo.php?del=<?php echo $value["idm"];?>&id=<?php echo $_GET["id"]; ?>&img=<?php echo $value["imagen"]; ?>"><i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Eliminar certicado"></i></a></td>
    </tr>


    <?php 
      # code...
    }
  }
    ?>


  </tbody>
</table>
</div>


</div>

<script>  
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>


</body>
</html>