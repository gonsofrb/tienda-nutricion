<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles1.css" />
  <!--  <script src="https://kit.fontawesome.com/5c32f8297e.js" crossorigin="anonymous"></script>-->
    <script type="text/javascript" src="<?=base_url?>script/validacion_contact.js" ></script>
    <script type="text/javascript" src="<?=base_url?>script/validacion_register.js" ></script>
   

    <title>Nutrición deportiva</title>
</head>

<body>
    <div id="container">
        <!--CABECERA-->
        <header id="header">
            <div id="logo">
                <img src="<?=base_url?>assets/img/logo1.jpg" alt="logo tienda" />
                <a href="<?=base_url?>">Nutricion deportiva</a>
            </div>
        </header>

        <!--MENU-->

        <?php $categorias = Utils::showCategorias();?>
       
        <nav id="menu">
            <ul>
                <li>
                    <a href="<?=base_url?>">Inicio</a>
                </li>

                <li>
                    <a href="<?=base_url?>usuario/contact">Contacto</a>
                </li>

                <?php while($cat = $categorias->fetch_object()) :?>

                <li>
                    <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                </li>

                <?php endwhile; ?>   
                
            </ul>
        </nav>
        <div id="content">