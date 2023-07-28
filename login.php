<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "Osc@r801223";
$dbname = "proyecto_final";


$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos enviados desde el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consulta para verificar las credenciales ingresadas
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Inicio de sesión exitoso, redireccionar a la página de inicio después del login
        session_start();
        $_SESSION['username'] = $username;
        header("Location: administracion.html");
        exit();
    } else {
        // Credenciales inválidas, mostrar un mensaje de error
        echo "Usuario o contraseña incorrectos.";
    }
}

$conn->close();
?>
