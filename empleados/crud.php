<?php
$servername = "localhost";
$username = "root";
$password = "Osc@r801223";
$dbname = "proyecto_final";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexion:" . $conn->connect_error);
}

if  ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identificacion = $_POST["identificacion"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $position = $_POST["position"];

    $sql = "INSERT INTO employees (identificacion, name, email, phone, position) VALUES ('$identificacion', '$name', '$email', '$phone', '$position')";

    if ($conn->query($sql) === TRUE) {
        header("location: empleados.html");
        exit();
    } else {
        echo "Error al agregar el empleado: " . $conn->error;
    }

}

$conn->close();


?>