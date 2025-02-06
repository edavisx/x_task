<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
}
if (!isset($_GET["tarea_id"])) {
    header("Location: main.php");
}
include("conexiondb.php");

if (isset($_POST["id"])) { //primera vez pasa a ELSE (no hay POST)
    try {
        //"UPDATE tareas SET fecha_creacion = '2023-02-05 16:12:40', descripcion = 'actualizado horita' WHERE tareas_id = :id";
        if  ($_POST['estado']==15) {
            $estado = 1;
        }    
        $sql = "UPDATE tareas SET estado = :estado, titulo = :titulo, fecha_creacion = :fecha, descripcion = :descripcion WHERE tareas_id = :id";
        $stm = $conexion->prepare($sql);
        $stm->bindParam(":fecha", $_POST["fecha"]);
        $stm->bindParam(":descripcion", $_POST["descripcion"]);
        $stm->bindParam(":id", $_POST["id"]);
        $stm->bindParam(":titulo", $_POST["titulo"]);
        $stm->bindParam(":estado", $estado);
        $stm->execute();
        header("Location: main.php"); 
    }
    catch (Exception $e) {
        $error="Error".$e->getMessage();
        echo "<br>";
        echo DB_USER. "  ".DB_PASS;
    }
} else {
    $sql = "SELECT * FROM tareas WHERE tareas_id = :tarea_id";
    $stm = $conexion->prepare($sql);
    $stm->bindParam(":tarea_id", $_GET["tarea_id"]);
    $stm->execute();
    $row = $stm->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        header("Location: main.php");
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web de TAREAS</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

<div class="contenedorPrincipal">
    <form action="" method="post">
        <label for="id">ID de Tarea</label>
        <input type="text" name="id" id="" readonly value="<?php echo $row['tareas_id'] ?>">
        <br>
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" value="2000-12-12">
        
        <br>
        <label for="titulo">Título de la Tarea (máx. 133 caracteres):</label>
        <input type="text" id="titulo" name="titulo" maxlength="133" placeholder="<?php echo $row['titulo'] ?>">
        <br>
        <label for="descripcion">Descripción de la Tarea (máx. 466 caracteres):</label>
        <textarea id="descripcion" name="descripcion" maxlength="466" rows="5" placeholder="<?php echo $row['descripcion'] ?>"></textarea>
        <br>
        <label for="estado">Marcar si se mantiene "En proceso" la tarea:</label>
        <input type="checkbox" id="completado" name="estado" value="15">
        <br>
        <input type="submit" value="Guardar cambios">
    </form>
</div>

<div>       
<?php if (isset($error)) {
            echo "<h2 style='background-color:red'>" . $error . "</h2>";
        }
        ?>
</div>

<button type="button" class="cancel" onclick="window.location.href='main.php';">Cancelar</button>


</body>

</html>