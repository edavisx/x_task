<?php
session_start();

if (isset($_SESSION['username'])) {
    try {
        include("conexiondb.php");

        $username = $_SESSION['username']; // Obtener el nombre de usuario desde la sesión

        // Consulta SQL para eliminar la cuenta del usuario de la base de datos
        $sql = "DELETE FROM usuarios WHERE username = :username";
        $stm = $conexion->prepare($sql);
        $stm->bindParam(":username", $username);

        // Ejecutar la consulta
        $stm->execute();

        // Destruir la sesión para cerrar la sesión del usuario
        session_destroy();

        // Redirigir al usuario a la página de inicio
        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        // Manejar errores
        echo "Error al eliminar la cuenta: " . $e->getMessage();
    }
} else {
    echo "No estás autenticado. No puedes eliminar tu cuenta.";
}

?>











