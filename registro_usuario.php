<?php

if (isset($_POST["apellido01_usuario"])) {
    try {
        include("conexiondb.php");
        $nombre = $_POST["nombre_usuario"];
        $apellido01 = $_POST["apellido01_usuario"];
        $apellido02 = $_POST["apellido02_usuario"];
        $apellidos = $apellido01 . " " . $apellido02;
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password_encriptado = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre,apellidos,username,password,password_encriptado) 
                VALUES (:nombre,:apellidos,:username,:password,:password_encriptado)";
        $stm = $conexion->prepare($sql);
        $stm->bindParam(":nombre", $nombre);
        $stm->bindParam(":apellidos", $apellidos);
        $stm->bindParam(":username", $username);
        $stm->bindParam(":password", $password);
        $stm->bindParam(":password_encriptado", $password_encriptado);
        $stm->execute();
        $conexion = null;
        header("Location: index.php");
    } catch (Exception $e) {
        $error = "Error al registrar usuario." . $e->getMessage();
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
    
    <h1>Registro nuevo usuario</h1>

    <form action="" method="post">
        <label for="registro_user" autocomplete="off">Datos de nuevo usuario</label>
        <input type="text" name="nombre_usuario" id="id_01" required placeholder="Nombre(s)" autocomplete="off">
        <input type="text" name="apellido01_usuario" id="id_02" required placeholder="Primer apellido" autocomplete="off">
        <input type="text" name="apellido02_usuario" id="" placeholder="Segundo apellido">
        <input type="text" name="username" id="" required placeholder="Ingrese un nombre de usuario">
        <input type="password" name="password" id="pass" required placeholder="Password">
        <input type="submit" value="Registrar">        
        
        <?php if (isset($error)) {
            echo "<h2 style='background-color:red'>" . $error . "</h2>";
        }
        ?>
    </form>

    <footer>
    <p> <a href="index.php">HOME</a> </p>
</footer>

</body>



</html>