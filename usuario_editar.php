<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
}

include("conexiondb.php");

if (isset($_POST["id"])) { //primera vez pasa a ELSE (no hay POST)
    try {
        //"UPDATE tareas SET fecha_creacion = '2023-02-05 16:12:40', descripcion = 'actualizado horita' WHERE tareas_id = :id";
        $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos WHERE usuarios_id = :id";
        $stm = $conexion->prepare($sql);
        $stm->bindParam(":nombre", $_POST["nombre"]);
        $stm->bindParam(":apellidos", $_POST["apellidos"]);
        $stm->bindParam(":id", $_POST["id"]);
        
        $stm->execute();

        $_SESSION["usuario_nombre"] = $_POST["nombre"];
        $_SESSION["usuario_apellidos"] = $_POST["apellidos"];
        

        header("Location: main.php"); 
    }
    catch (Exception $e) {
        $error="Error al iniciar sesión, contacte con el administrador".$e->getMessage();
        echo "<br>";
        echo DB_USER. "  ".DB_PASS;
    }
} else {
    $sql = "SELECT * FROM usuarios WHERE usuarios_id = :usuario_id";
    $stm = $conexion->prepare($sql);
    $stm->bindParam(":usuario_id", $_SESSION["usuario_id"]);
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

<h2> Datos del usuario </h2>
<div class="contenedorPrincipal">
    <form action="" method="post">
        <label for="id">ID de usuario</label>
        <input type="text" name="id" id="" readonly value="<?php echo $row['usuarios_id'] ?>">
        <br>
        <label for="nombre">Nombre:</label>
        <input type="text" id="" name="nombre" maxlength="133" require placeholder="<?php echo $row['nombre'] ?>">
        <br>
        
        <label for="nombre">Apellidos:</label>
        <input type="text" id="" name="apellidos" maxlength="133" require placeholder="<?php echo $row['apellidos'] ?>">
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
<br>
<button type="button" class="cancel" onclick="window.location.href='usuario_Baja.php';">Darse de baja</button>



</body>

</html>