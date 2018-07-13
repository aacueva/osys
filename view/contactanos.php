<?php
    require_once("header.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="css/fontello.css">
<link rel="stylesheet" type="text/css" href="css/estilos.css">
<link rel="stylesheet" type="text/css" href="css/banner.css">
<link rel="stylesheet" type="text/css" href="css/footer.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/proveedores.css">


<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/form_contacto.css">

    
     
   <title>Sr Code</title>


</head>
<body>


 <form role="form">
  <h1>E S C R I B E N O S</h1>
  <div class="form-group">
    <label for="ejemplo_email_1">Email</label>
    <input type="email" class="form-control" id="ejemplo_email_1"
           placeholder="Introduce tu email">
  </div>
  <div class="form-group">
    <label for="ejemplo_password_1">Nombre y Apellido</label>
    <input type="text" class="form-control" id="nombre" 
           placeholder="Tu nombre">
  </div>
  <div class="form-group">
    <label for="ejemplo_password_1">Asunto</label>
    <input type="text" class="form-control" id="asunto" 
           placeholder="...">
  </div>
  <div class="form-group">
    <label for="">Escribenos...</label>
    <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
    
  </div>
  
  <button type="submit" class="btn btn-danger">Enviar</button>
</form>



<div  id="mapa">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1631.8016404076363!2d-76.12869657022803!3d-13.406119532410225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9110165ec4868627%3A0xf98f9379e6ce1b5c!2sOSYS+TECHNOLOGY+E.I.R.L.!5e0!3m2!1ses!2spe!4v1518903766331" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>

<?php
    require_once("footer.php");
?>

</body>
</html>