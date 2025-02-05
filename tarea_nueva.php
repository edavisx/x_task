<?php
session_start();

if (isset($_POST["titulo"])) {
    try {
            echo "entra en el if";
            include("conexiondb.php");
            echo "conexion establecida";
            
            $titulo = $_POST["titulo"];
            echo $titulo;
            echo "<br>";
            $decripcion = $_POST["descripcion"];
            echo $decripcion;
            echo "<br>";
            $usuarios_id = $_SESSION['usuario_id'];
            echo $usuarios_id;
            echo "<br>";
            $estado = 1;
            echo $estado;
            echo "<br>";
            //$fecha_local = $_SESSION['fecha_local'];
            $sql = "INSERT INTO tareas (titulo,descripcion,usuarios_id,estado) 
                    VALUES (:t,:d,:u,:e)";
                   // INSERT INTO Tareas (usuarios_id, titulo, descripcion) VALUES (32, 'ttttt', 'dddd');
            $stm = $conexion->prepare($sql);
            
            $stm->bindParam(":t", $titulo);
            $stm->bindParam(":d", $descripcion);
            $stm->bindParam(":u", $usuarios_id);
            $stm->bindParam(":e", $estado);
            //$stm->bindParam(":f", $fecha_local);
            $stm->execute();
            echo "tarea guardada";
            $conexion = null;
            //header("Location: main.php");
        } catch (Exception $e) {
            $error = "ERROR. <br>" . $e->getMessage();
            echo $error;
        }
    }

?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Tarea</title>
    <!-- <link rel="stylesheet" href="css/style_01.css"> -->
   
</head>
<body>
    <h2>Formulario de Tarea</h2>
    <form method="POST" action="" id="miFormulario">
        <div>
            <label for="titulo">Título de la Tarea (máx. 133 caracteres):</label>
            <input type="text" id="titulo" name="titulo" maxlength="133" required>
        </div>
        <div>
            <label for="descripcion">Descripción de la Tarea (máx. 466 caracteres):</label>
            <textarea id="descripcion" name="descripcion" maxlength="466" rows="5" required></textarea>
        </div>
        <div>
            <input type="submit" value="Guardar Tarea">
        </div>
    </form>

<footer>
    <p> <button onclick="window.location.href='main.php';">CANCELAR</button> </p>
</footer>

</body>
</html>

