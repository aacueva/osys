<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" type="text/css"  href="css/banner.css">
<link rel="stylesheet" type="text/css" href="css/proveedores.css">
<link rel="stylesheet" href="css/fontello.css">
<link rel="stylesheet" type="text/css" href="css/estilos.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/slick.css">
<link rel="stylesheet" type="text/css" href="css/footer.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/form_contacto.css">
<link rel="stylesheet" href="css/blog.css">

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>


<title>Sr Code</title>

<style>
  .contacto:hover{
    background: white;
    color: white;
  }
</style>

</head>
<body>
<?php
    require_once("header.php");
?>
    <main>
        <section id="banner">
            <img src="img/fondo2.png" alt="">
            <div class="contenedor">
                <h2>
                    OSYS' Technology E.I.R.L.
                </h2>
                <p>
                    ¡Todo lo que necesitas para el cole y tu empresa!
                </p>
                <button class="contacto"><a href="contactanos.php" class="botons">Contactanos</a></button>
            </div>          
        </section>

        <section id="provedor">
            <div class= "contenedor">   
            <article>
                <img src="img/artesco.png" alt="">
            </article>
            <article>
                <img src="img/college.png" alt="">
            </article>
            <article>
                <img src="img/faber.jpg" alt="">
            </article>
            <article>
                <img src="img/layconsa.png" alt="">
            </article>
            <article>
                <img src="img/norma.png" alt="">
            </article>
            <article>
                <img src="img/pilot.jpg" alt="">
            </article>
            <article>
                <img src="img/stabilo.png" alt="">
            </article>
            <article>
                <img src="img/standford.jpg" alt="">
            </article>
            
            </div>
        </section>
    </main>
   <?php
    require_once("footer.php");
    ?>
    
</body>
</html>
