<?php
if(isset($_GET["tarea_id"])){
    include("conexiondb.php");
    $tarea_id = $_GET["tarea_id"];
    $sql = "DELETE FROM tareas WHERE tareas_id = :tarea_id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':tarea_id', $tarea_id);
    $stmt->execute();
    $conexion = null;
    header("Location: main.php");
}

?>