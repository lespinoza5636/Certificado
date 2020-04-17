<?php
    session_start();
    include("cer.php");
    $participantes = new Certificados();

    if (!isset($_SESSION["id"]))
    {
        header("Location: login.php");
    }

    if (isset($_GET["del"]))
    {
      $datos_del = $participantes->delParticipante($_GET["del"]);
      $id = $_GET["id"];
      if ($datos_del)
      {
        echo "<script type='text/javascript'>window.location='cerlista.php?id=$id&d=1';
        </script>";
      }
      else
      {
        echo "<script type='text/javascript'>window.location='cerlista.php?id=$id&d=2';
        </script>";
      }
    }

    if(isset($_POST["idCer"]))
    {
      $resultado = $participantes->delCer($_POST["idCer"]);
    }

    if (isset($_GET["fil"]) and isset($_GET["id"]))
    {
      $id = $_GET["id"];
        setcookie("cedula", "", time() - (21600 * 30), "/"); // 21600 = 6 horas
        setcookie("nombre", "", time() - (21600 * 30), "/"); // 21600 = 6 horas
        setcookie("apellido", "", time() - (21600 * 30), "/"); // 21600 = 6 horas
        setcookie("id", "", time() - (21600 * 30), "/"); // 21600 = 6 horas
        
        echo "<script type='text/javascript'>window.location='cerlista.php?id=$id';
        </script>";
    }

    if (isset($_GET["id"]) or isset($_COOKIE["id"]) or isset($_POST["id"]))
    {
      if (isset($_POST["cedula"]) && isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["id"]))
      {
        //Documentación: https://www.w3schools.com/php/php_cookies.asp
        setcookie("cedula", $_POST["cedula"], time() + (21600 * 30), "/"); // 21600 = 6 horas
        setcookie("nombre", $_POST["nombre"], time() + (21600 * 30), "/"); // 21600 = 6 horas
        setcookie("apellido", $_POST["apellido"], time() + (21600 * 30), "/"); // 21600 = 6 horas
        setcookie("id", $_POST["id"], time() + (21600 * 30), "/"); // 21600 = 6 horas

        $id = $_POST["id"];
        echo "<script type='text/javascript'>window.location='cerlista.php?id=$id';
        </script>";
      }else
      if (isset($_COOKIE["cedula"]) or isset($_COOKIE["nombre"]) or isset($_COOKIE["apellido"]) or isset($_COOKIE["id"]))
      {
        $datos = $participantes->getListaParticipanteFiltro();
      }
      else
      {
        $datos = $participantes->getListaParticipante($_GET["id"]);
      } 
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
<br>
<div class="row cuerpo">
<div class="col-md-12">

<div class="row">
    <div class="col-md-11"><h2>Lista de participantes </h2>
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
            <form class="col-12" method="POST" action="cerlista.php">
            <div class="form-group">
                <label for="cedula">Cédula</label>
                <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Ingrese la cédula">
                <input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese un nombre">
            </div>

            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese un apellido">
            </div>
            <input type="button" value="Atrás" onclick="atras()" class="btn btn-info" />
            <button type="submit" class="btn btn-success">
              Filtrar
            </button>
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
      <td>  




      <a href="#" data-toggle="modal" data-target="#exampleModal<?php echo $value["cedula"]; ?>"><i class="fas fa-certificate" data-toggle="tooltip" data-placement="top" title="Certificado"></i></a> 
     
     
     <?php
     $cerp = $participantes->getCertificadoParticipante($_GET["id"], $value["cedula"]);
     ?>
     
     
<!-- - -->


<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $value["cedula"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Certificados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Código</th>
      <th scope="col">Congreso</th>
      <th scope="col">Tipo</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>

<?php

if ($cerp!=false)
{

  foreach ($cerp as $key => $certificado) {

?>
    <tr id="<?php echo $certificado["codigo"]; ?>">
      <th scope="row"><?php echo $certificado["codigo"]; ?>
      
      </th>
      <td><?php echo $certificado["congreso"]; ?></td>
      <td><?php echo $certificado["tipo"]; ?></td>
      <td>
      <a href="#" class="cerp">
      <input type="hidden" id="codigo" class="codigo" name="codigo" value="<?php echo $certificado["codigo"]; ?>">
      <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Eliminar certificado">
      </i></a></td>
    </tr>
<?php
  }
    
}
?>

  </tbody>
</table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>


<!-- - -->



     
      </td>
      <td><a href="cerlista.php?del=<?php echo $value["cedula"];?>&id=<?php echo $_GET["id"];?>"><i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Eliminar participante"></i></a></td>
    </tr>
    <?php 
      # code...
      $i++;
    }
  }
    ?>
  </tbody>
</table>
<?php
if (isset($_COOKIE["cedula"]) or isset($_COOKIE["nombre"]) or isset($_COOKIE["apellido"]) or isset($_COOKIE["id"]))
{
?>
<h4>Filtros</h4>
<?php if(isset($_COOKIE["cedula"])){
?>
<span class="badge badge-primary"><?php echo $_COOKIE["cedula"]; ?></span>
<?php
} ?>
<?php if(isset($_COOKIE["nombre"])){
?>
<span class="badge badge-primary"><?php echo $_COOKIE["nombre"]; ?></span>
<?php
} ?>
<?php if(isset($_COOKIE["apellido"])){
?>
<span class="badge badge-primary"><?php echo $_COOKIE["apellido"]; ?></span>
<?php
} ?>

<a href="cerlista.php?id=<?php echo $_COOKIE["id"]; ?>&fil=0" class="badge badge-danger">Eliminar filtros</a>

<?php } ?>
</div>
    </div>
        </div>

</div>
</div>

<script
              src="https://code.jquery.com/jquery-3.3.1.min.js"
              integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
              crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<script>  
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function(){
  $(".cerp").click(function(){

    $.post("cerlista.php",
    {
      idCer: $(this).find("input").val()
    },
    function(data,status){
      //alert("Data: " + data + "\nStatus: " + status);
      alert("Certificado eliminado");
    });
    $(this).closest('tr').remove();
  });
});
</script>
</body>
</html>