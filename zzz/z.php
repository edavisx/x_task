if (isset($_POST["apellido01_usuario"])) {
    try {
        include("conexiondb.php");
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM usuarios WHERE nombre = :username";
        $stm = $conexion->prepare($sql);
        $stm->bindParam(":username", $username);
        $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            //if (password_verify($password, $row["password"])) {
            if (password_verify($password, $row["password_encriptado"])) {
                session_start();
                $_SESSION["username"] = $username;
                header("Location: tienda");
            } else {
                $error = "Usuario o contraseña incorrectos";
            }
        } else {
            $error = "Usuario o contraseña incorrectos";
        }
    } catch (Exception $e) {
        
        $error="Nombre de usuario No válido.".$e->getMessage();
        echo "<br>";
        echo DB_USER. "  ".DB_PASS;
    }

}

session_start();
include("conexiondb.php");
$fecha = $_POST["fecha"];
$descripcion = $_POST["descripcion"];
$idusuario = $_SESSION['idusuario'];
$sql = "INSERT INTO incidencias (fecha,descripcion,idusuario) VALUES (:fecha,:descripcion,:idusuario)";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':fecha', $fecha);
$stmt->bindParam(':descripcion', $descripcion);
$stmt->bindParam(':idusuario', $idusuario);
$stmt->execute();
$conexion = null;
header("Location: main.php");




