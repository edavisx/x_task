<?php
session_start();

if (isset($_POST["titulo"])) {
    try {
            include("conexiondb.php");
            
            $titulo = $_POST["titulo"];
            $usuarios_id = $_SESSION['usuario_id'];
            $estado = 1;
            $sql = "INSERT INTO tareas (titulo,descripcion,usuarios_id,estado) 
                    VALUES (:t,:d,:u,:e)";
            
            $stm = $conexion->prepare($sql);
          
            $stm->bindParam(":t", $titulo);
            $stm->bindParam(":d", $_POST["descripcion"]);
            $stm->bindParam(":u", $usuarios_id);
            $stm->bindParam(":e", $estado);
 
            $stm->execute();
 
            $conexion = null;
            header("Location: main.php");
        } catch (Exception $e) {
            $error = "ERROR. <br>" . $e->getMessage();
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
    <h2>NUEVA TAREA</h2>
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

        <?php if (isset($error)) {
            echo "<h2 style='background-color:red'>" . $error . "</h2>";
        }

        ?>

    </form>



<button type="button" class="cancel" onclick="window.location.href='main.php';">Cancelar</button>
  
</body>
</html>

