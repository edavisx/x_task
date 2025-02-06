<?php 
session_start();

if (! isset($_SESSION["username"])) {
    header("Location: index.php");
}
include("conexiondb.php");
try{
    $usuario_ID = $_SESSION['usuario_id'];
    $sql = "SELECT * from tareas WHERE usuarios_id=" . $usuario_ID . ";";
    $result = $conexion->query($sql);
} 
catch (Exception $e) {
            $error = "ERROR. <br>" . $e->getMessage();
}


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web de TAREAS</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    
    <h1>Usuario:  
        <?php   echo $_SESSION["usuario_nombre"] . " " . $_SESSION["usuario_apellidos"];
        ?>
    </h1>
    <p><button type="button" class="boton01" onclick="window.location.href='usuario_editar.php';">Editar datos de usuario</button>
    </p>
    <p><button type="button" class="boton02" onclick="window.location.href='usuario_logout.php';">Cerrar cesión</button>
    </p>    
    <p><button type="button" class="boton03" onclick="window.location.href='tarea_nueva.php';">Crear nueva tarea</button>
    </p>
    
    <section class="contenedorPrincipal">
            <h3>Listado tareas del usuario con ID <?php echo $_SESSION['usuario_id'] ?> </h3>
    
            <div class="lista">
                <table id="tablaIncidencias">
                    <thead>
                        <th>Fecha de creación (hora servidor)</th>
                        <th>Título de la tarea</th>
                        <th>Estado</th>
                        <th>ID de la Tarea</th>
                        <th>Operaciones</th>
                    </thead>
                    <tbody id="tbodyTareas">

                        <?php
                        while ($row = $result->fetch()) {
                            if ($row['estado'] == null) 
                                {$estado = 'Terminado';} else {$estado = 'En proceso';}
                            echo "<tr>                            
                            <td>" . 
                                $row['fecha_creacion'] .
                            "</td>
                            <td>" . 
                                $row['titulo'] .
                            "</td>" . 
                            "<td>". 
                                $estado .
                            "</td>" . 
                            "<td>". 
                                $row['tareas_id'] .
                            "</td>" .
                            "<td> 
                                <a href='tarea_ver.php?tarea_id="
                                    . $row['tareas_id']."'>ver</a> 
                                | 
                                <a href='tarea_editar.php?tarea_id="
                                    . $row['tareas_id']."'>editar</a>
                                | 
                                <a href='tarea_borrar.php?tarea_id="
                                    . $row['tareas_id']."'>eliminar</a>
                            </td>
                            </tr>";

                        }
                        ?>
                        
                    </tbody>

                </table>
            </div>
        </section>

    <?php if (isset($error)) {
        echo "<h2 style='background-color:red'>" . $error . "</h2>";
    }
    ?>
    <footer>X TASK APP © 2025 Todos los derechos reservados.</footer>
</body>



</html>