<?php
if(isset($_GET["idincidencia"])){
    include("conexiondb.php");
    $idincidencia = $_GET["idincidencia"];
    $sql = "DELETE FROM incidencias WHERE id = :idincidencia";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':idincidencia', $idincidencia);
    $stmt->execute();
    $conexion = null;
    header("Location: main.php");
}

?>