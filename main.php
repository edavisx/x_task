<?php
session_start();
$_SESSION["username"];
$_SESSION["usuario_nombre"];
$_SESSION["usuario_apellidos"];
$_SESSION["usuario_id"];
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web de TAREAS</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <header>
        <h1>Bienvenido a X TASK</h1>

        <nav>
            <ul>
                <li><a href="eliminar_cuenta.php">Eliminar cuenta</a></li> | <li><a href="editar_datos.php">Editar datos</a></li> | <li>Username</li>

            </ul>
        </nav>
    </header>
    <div class="container">


        <div class="contenedorPrincipal">
            <h3>Crea tu nueva tarea:</h3>
            <form action="" class="formularioTarea">
                <label for="tarea">Título</label>
                <input type="text" name="tarea" id="tarea" required placeholder="Tarea">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" required placeholder="Descripción">
                <label for="fecha">Fecha de creación</label>
                <input type="date" name="fecha" id="fecha" required placeholder="Fecha">
                <label for="text">Selecciona un estado</label>
                <select name="color" id="color">
                    <option value="rojo">Pendiente</option>
                    <option value="azul">En proceso</option>
                    <option value="verde">Completada</option>
                </select>
                <input type="submit" value="Crear tarea">
            </form>
        </div>
        <section class="contenedorPrincipal">
            <h3>Sus Tasks</h3>
            <div class="lista">
                <table id="tablaIncidencias">
                    <thead>
                        <th>Task</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Operaciones</th>
                    </thead>
                    <tbody id="tbodyIncidencias">
                        <tr>
                            <td>1</td>
                            <td>2021-01-01</td>
                            <td>Descripción de la tarea</td>
                            <td>
                                <button>Ver</button>
                                <button>Editar</button>
                                <button>Eliminar</button>
                            </td>
                        </tr>


                </table>
            </div>

        </section>

    </div>


    <footer>X TASK APP © 2025 Todos los derechos reservados. </footer>

</body>


</html>