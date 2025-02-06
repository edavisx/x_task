<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
}
if (!isset($_GET["tarea_id"])) {
    header("Location: main.php");
}
include("conexiondb.php");

try {
    $sql = "SELECT * FROM tareas WHERE tareas_id = :tarea_id";
    $stm = $conexion->prepare($sql);
    $stm->bindParam(":tarea_id", $_GET["tarea_id"]);
    $stm->execute();
    $row = $stm->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        header("Location: main.php");
    }
} catch (Exception $e) {
    $error = "ERROR. <br>" . $e->getMessage();   
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web de TAREAS</title>
    <link rel="stylesheet" href="css/tarea_ver.css">
</head>

<body>

<h2>Datos de la tarea ID=<?php echo $row['tareas_id'] ?></h2>
<div class="contenedorPrincipal">
    <form action="" method="">
        
        <label for="fecha">Fecha de creación</label>
        <input type="text" name="fecha" id="fecha" value="<?php echo $row['fecha_creacion'] ?>" readonly>
        <br>
        <br>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" maxlength="133" value="<?php echo $row['titulo'] ?>" readonly>
        <br>
        <br>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" maxlength="466" rows="5" placeholder="<?php echo $row['descripcion'] ?>" readonly></textarea>
        <br>
        <br>
        <label for="estado">Estado:</label>
        <input type="text" id="" name="estado" value="<?php if ($row['estado'] == null) {echo 'Terminado';} else {echo 'En proceso';} ?>" readonly>
        <br>
        <br>
        



    </form>
</div>

<div>       
<?php if (isset($error)) {
            echo "<h2 style='background-color:red'>" . $error . "</h2>";
        }
        ?>
</div>

<form action="main.php" method="">
    <input type="submit" value="VOLVER">        
</form>

<form action="tarea_editar.php" method="GET">
    <input type="hidden" name="tarea_id" id="" readonly value="<?php echo $row['tareas_id'] ?>">
    <input type="submit" value="EDITAR">
</form>

<form action="tarea_borrar.php" method="GET">
    <input type="hidden" name="tarea_id" id="" readonly value="<?php echo $row['tareas_id'] ?>">
    <input type="submit" value="ELIMINAR TAREA">
</form>



</body>

</html>