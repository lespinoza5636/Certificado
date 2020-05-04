<?php
    session_start();
    include("eventos.php");
    $eventos = new Eventos();

    if (!isset($_SESSION["id"]))
    {
        header("Location: login.php");
    }

    if (isset($_POST["nombre"]) and isset($_POST["fi"]) and isset($_POST["ff"]))
    {
      $validar = $eventos->setEvento($_POST["nombre"], $_POST["fi"], $_POST["ff"]);

      if ($validar == true)
      {
        echo "<script type='text/javascript'>window.location='panel.php?v=1';
        </script>";
      }
      else
      {
        echo "<script type='text/javascript'>window.location='panel.php?v=2';
        </script>";
      }
    }

    if (isset($_GET["del"]))
    {
      $validar = $eventos->deleteEvento($_GET["del"]);

      if ($validar == true)
      {
        echo "<script type='text/javascript'>window.location='panel.php?d=1';
        </script>";
      }
      else
      {
        echo "<script type='text/javascript'>window.location='panel.php?d=2';
        </script>";
      }
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
  <img src="imagenes/banner.png" alt="Smiley face" height="100%" width="100%">
</div>
<div class="row">

</div>
<br>
<br>
<div class="row cuerpo">

<h2>Lista de eventos </h2><hr />
<br>
<br>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Fecha de inicio</th>
      <th scope="col">Fecha de fin</th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>

  <?php 
  $datos = $eventos->getEvento();
  if ($datos != false)
  {
    
    $i=1;
    foreach ($datos as $key => $value) {
  ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $value["nombre"]; ?></td>
      <td><?php echo date("d/m/Y", strtotime($value["fi"])); ?></td>
      <td><?php echo date("d/m/Y", strtotime($value["ff"])); ?></td>
      <td><a href="panel.php?del=<?php echo $value["idevento"];?>"><i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Eliminar congreso"></i></a></td>
      <td><a href="cerlista.php?id=<?php echo $value["idevento"];?>"><i class="fas fa-users" data-toggle="tooltip" data-placement="top" title="Listar participantes"></i></a></td>
      <td><a href="pe.php?id=<?php echo $value["idevento"];?>"><i class="fas fa-user-plus" data-toggle="tooltip" data-placement="top" title="Agregar participantes"></i></a></td>
      <td><a href="modelo.php?id=<?php echo $value["idevento"];?>"><i class="fas fa-certificate" data-toggle="tooltip" data-placement="top" title="Agregar modelo de certificado"></i></a></td>
      
    </tr>
    <?php 
      # code...
      $i++;
    }
  }
    ?>
  </tbody>
</table>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
  Agregar evento
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="panel.php" method="POST">
      <div class="modal-body">
          
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
            </div>

            <div class="form-group">
                <label for="fi">Fecha de inicio</label>
                <input type="date" name="fi" id="fi" class="form-control">
            </div>


            <div class="form-group">
                <label for="ff">Fecha de fin</label>
                <input type="date" name="ff" id="ff" class="form-control">
            </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
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