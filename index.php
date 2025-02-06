<?php
if (isset($_POST["username"])) {
    echo "hay POST";
    try {
        include("conexiondb.php");
        //echo "conexion establecida";
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM usuarios WHERE username = :username";
        $stm = $conexion->prepare($sql);
        $stm->bindParam(":username", $username);
        $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            //echo "<h2> Usuario encontrado </h2>";
            //echo "<h2> Usuario: " . $row["nombre"] . "</h2>";
            // echo "<h2> Contraseña: " . $row["password"] . "</h2>";
            // echo "<h2> Contraseña encriptada: " . $row["password_encriptado"] . "</h2>";
            //if (password_verify($password, $row["password"])) {
            if (password_verify($password, $row["password_encriptado"])) {
                session_start();
                $_SESSION["username"] = $username;
                $_SESSION["usuario_nombre"] = $row["nombre"];
                $_SESSION["usuario_apellidos"] = $row["apellidos"];
                $_SESSION["usuario_id"] = $row["usuarios_id"];
                header("Location: main.php");
            } else {
                $error = "Usuario o contraseña incorrectos";
            }
        } else {
            $error = "Usuario o contraseña incorrectos...";
        }
    } catch (Exception $e) {
        
        $error="Error al iniciar sesión, contacte con el administrador".$e->getMessage();
        echo "<br>";
        echo DB_USER. "  ".DB_PASS;
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
    
    <h1>GESTIÓN DE TAREAS X TASK</h1>

    <p>En esta web podrás realizar las siguientes tareas:</p>
    <ul>
        <li>Crear tareas</li>
        <li>Editar tareas</li>
        <li>Eliminar tareas</li>
        <li>Marcar tareas como completadas</li>
    </ul>

    <p>Para poder trabajar con las tareas, por favor inicie sesión</p>

    
    <form action="" method="post">
        <h1>Iniciar sesión</h1>
        <label for="username">Nombre de usuario</label>
        <input type="text" name="username" id="" required placeholder="Username">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="" required placeholder="Password">
        <input type="submit" value="Iniciar sesión">
        <?php if (isset($error)) {
            echo "<h2 style='background-color:red'>" . $error . "</h2>";
        }
        ?>
    </form>

    <h2>¿No tienes una cuenta?</h2>
    <p>Regístrate <a href="registro_usuario.php">aquí.</a></p>

    <footer>X TASK APP © 2025 Todos los derechos reservados. </footer>
</body>

</html>