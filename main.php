<?php 
session_start();
// echo $_SESSION["username"];
// echo "<br>";
// echo $_SESSION["usuario_nombre"];
// echo "<br>";
// echo $_SESSION["usuario_apellidos"];
// echo "<br>";
// echo $_SESSION["usuario_id"];
// echo "<br>";

if (! isset($_SESSION["username"])) {
    header("Location: index.php");
}
include("conexiondb.php");
$usuario_ID = $_SESSION['usuario_id'];
$sql = "SELECT * from tareas WHERE usuarios_id=" . $usuario_ID . ";";
$result = $conexion->query($sql);

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web de TAREAS</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    
    <h1>usuario: 
        <?php   echo $_SESSION["usuario_nombre"] . " " . $_SESSION["usuario_apellidos"];
        ?>
    </h1>
    
    <section class="contenedorPrincipal">
            <h3>Listado incidencias</h3>
            <div class="incidencias">
                <form action="editar_usuario.php" method="post" id="formIncidencias">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" value="">
                    <label for="descripcion">Descripcion</label>
                    <input required type="text" name="descripcion" id="descripcion">
                    <button>Enviar</button>
                </form>
            </div>
            <div class="lista">
                <table id="tablaIncidencias">
                    <thead>
                        <th>Id</th>
                        <th>fecha</th>
                        <th>Título de la tarea</th>
                        <th>Operaciones</th>
                    </thead>
                    <tbody id="tbodyIncidencias">
                        <?php
                        while ($row = $result->fetch()) {
                            echo "<tr>
                            <td>".$row['usuarios_id']."</td>
                            <td>".$row['fecha_creacion']."</td>
                            <td>".$row['titulo']."</td>
                            <td> ver | editar | eliminar</td>
                            <td>
                                <a href='borrar_incidencia.php?idincidencia=".$row['tareas_id']."'><i class='fa-solid fa-trash'></i></a>
                                <a href='editar_incidencia.php?idincidencia=".$row['tareas_id']."'<i class='fa-solid fa-pen-to-square'></i></a>
                            </td>
                            </tr>";

                        }
                        ?>
                        


                </table>
            </div>
        </section>
    
</body>



</html>