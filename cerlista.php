<?php
    session_start();
    include("cer.php");
    $participantes = new Certificados();

    if (!isset($_SESSION["id"]))
    {
        header("Location: login.php");
    }

    if (isset($_GET["id"]))
    {
        $datos = $participantes->getListaParticipante($_GET["id"]);
    }
    else
    {
        echo "<script type='text/javascript'>window.location='panel.php';
        </script>";
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
<div class="row cuerpo">
<div class="col-md-12">

<div class="row">
    <div class="col-md-11">
        <i class="fas fa-backward fa-2x"></i><h2>Lista de participantes </h2>
        <hr />
    </div>
    <div class="col-md-1">
        
    </div>
</div>

        <div class="row">
    <div class="col-md-3">
        <section class="h-100">
        <header class="container h-100">
            <div class="d-flex align-items-center justify-content-center h-100">
            <div class="d-flex flex-column">
            <form class="col-12">
            <div class="form-group">
                <label for="cedula">Cédula</label>
                <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Ingrese la cédula">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese un nombre">
            </div>

            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese un apellido">
            </div>
            </form>   
            </div>
            </div>
        </header>
        </section>
        </div>
        <div class="col-md-9">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Cédula</th>
      <th scope="col">Apellido</th>
      <th scope="col">Correo</th>
      <th></th>
    </tr>
  </thead>
  <tbody>

  <?php 
  if ($datos != false)
  {
    
    $i=1;
    foreach ($datos as $key => $value) {
  ?>
    <tr>
      <th scope="row"><?php echo $value["cedula"]; ?></th>
      <td><?php echo $value["nombre"]; ?></td>
      <td><?php echo $value["apellido"]; ?></td>
      <td><?php echo $value["correo"]; ?></td>
      <td><a href="panel.php?del=<?php echo $value["idevento"];?>"><i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Eliminar participante"></i></a></td>
    </tr>
    <?php 
      # code...
      $i++;
    }
  }
    ?>
  </tbody>
</table>
<button type="button" class="btn btn-success">
  Filtrar
</button>
</div>
    </div>
        </div>

</div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>  
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
</body>
</html>