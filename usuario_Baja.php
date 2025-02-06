<?php
session_start();
if (! isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
}


if(isset($_GET["respuesta"])) {
    
    if ($_GET["respuesta"] == 'si') {
        include("conexiondb.php");
        try {
            
            $usuario_id = $_SESSION["usuario_id"];
            $sql = "DELETE FROM usuarios WHERE usuarios_id = :usuario_id";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->execute();
            $conexion = null;
        
            header("Location: usuario_logout.php");
        }
        catch (Exception $e) {
            $error="Error ".$e->getMessage();
            echo "<br>";
            echo DB_USER. "  ".DB_PASS;
        }
    }
    
    if($_GET["respuesta"] == 'no') {
        header("Location: main.php");
    }


}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Baja</title>

</head>
<body>
    <div class="container">
        <h2>¿Seguro desea darse de baja, eliminando todos sus datos?</h2>
        <form method="GET" action="">
            <button type="submit" name="respuesta" value="si" class="button yes">Sí</button>
            <button type="submit" name="respuesta" value="no" class="button no">No</button>
        </form>
    </div>

    <?php if (isset($error)) {
            echo "<h2 style='background-color:red'>" . $error . "</h2>";
    }

    ?>
    
</body>
</html>
