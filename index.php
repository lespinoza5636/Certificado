<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validar certificados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
    <style>
        .banner
        {
            width: 100%;
            height: 100px;
            background: red;
            margin-bottom: 40px;
        }

        footer{
            background: #145e8c;
            color: white;
            position: absolute;
  bottom: 0;
  width: 100%;
  height: 40px;

  display: flex;
justify-content: center;
align-items: center;
        }
    </style>
</head>
<body>

<div class="banner">
    banner
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center" style="margin-bottom: 40px;">Sistema de Validación de Certificados</h1>
        

<div class="alert alert-info" role="alert">
<span style="font-weight: bold;">Info!</span>    El Sistema de Validación de Certificados permite verificar la autenticidad de los certificados emitidos por la Dirección de Educación a Distancia Virtual de la Universidad Nacional Autónoma de Nicaragua, Managua.
</div>

<div class="alert alert-success" role="alert">
<span style="font-weight: bold;">Recuerde:</span>  Todos los certificados emitidos poseen un código único de validación.
</div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4">
            <img src="imagenes/diploma.jpg" style="width: 90%" alt="">
        </div>
        <div class="col-md-8">
            <span>
            Para validar la autenticidad de un certificado, ingrese el código que aparece en la parte inferior del certificado. Luego marque la casilla de verificación "No soy un robot" y para finalizar, haga clic en el botón “Validar”.
            </span>

            <br><br>
            <form action="index.php" method="get">
            <div class="form-row align-items-center">
            <div class="col-sm-8 my-1">
            <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-barcode"></i>
</div>
        </div>
        <input type="text" class="form-control" id="codigo" placeholder="Código del Certificado">
      </div>
            </div>
      <div class="col-auto my-1">
      <button type="submit" class="btn btn-primary">Consultar</button>
    </div>
            </div>
            </form>
        </div>
    </div>
</div>

<hr>
<br><br>




<footer class="text-center">Copyright © 2019 UNAN-Managua | Departamento de Tecnología Educativa</footer>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>