<?php
$foto=$_SESSION["foto"];
if($foto==""){
    $foto="img/ususario.jfif";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header>
        <img src="img/logo.svg" alt="">
        <div>
            <img id="imgUser" class="imgUser" src="<?php echo $foto; ?>" alt="" srcset="">
            <div class="menuUser" id="menuUser">
                <ul>
                    <li><a href="datos_usuario.php">Datos de usuario</a></li>
                    <li><a href="cerrar_session.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </header>
    <main>
        <aside>
            <ul>
                <li><i class="fa-solid fa-cart-shopping"></i>Pedidos</li>
                <li><i class="fa-solid fa-file-invoice"></i>Facturas</li>
                <li><i class="fa-solid fa-circle-exclamation"></i>Incidencias</li>
                <li><i class="fa-solid fa-calendar"></i>Calendario</li>
                <li><i class="fa-solid fa-newspaper"></i>Presupuestos</li>
            </ul>

        </aside>
        <div class="asideMovil">
            <i id="menuMovil" class="fa-solid fa-bars"></i>
            <ul id="menu">
                <li><i class="fa-solid fa-cart-shopping"></i>Pedidos</li>
                <li><i class="fa-solid fa-file-invoice"></i>Facturas</li>
                <li><i class="fa-solid fa-circle-exclamation"></i>Incidencias</li>
                <li><i class="fa-solid fa-calendar"></i>Calendario</li>
                <li><i class="fa-solid fa-newspaper"></i>Presupuestos</li>
            </ul>
        </div>