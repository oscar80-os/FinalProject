<?php
$servername = "localhost";
$username = "root";
$password = "Osc@r801223";
$dbname = "proyecto_final";

// Conexión a la base de datos 

$conn = new mysqli($servername, $username, $password, $dbname);

//verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
//CREATE TABLE menu (
   //id INT AUTO_INCREMENT PRIMARY KEY,
    //nombre_plato VARCHAR(50),
    //ingredientes VARCHAR(500),
    //receta VARCHAR(1000),
    //personalizado VARCHAR(1000),
   // chef_encargado VARCHAR(100),
   // observaciones VARCHAR(500)
//);
// Crear Nuevo Plato
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_menu"])) {
    $nombre_plato = $_POST["nombre_plato"];
    $ingredientes = $_POST["ingredientes"];
    $receta = $_POST["receta"];
    $personalizado = $_POST["personalizado"];
    $chef_encargado = $_POST["chef_encargado"];
    $observaciones = $_POST["observaciones"];

    $sql = "INSERT INTO menu (nombre_plato, ingredientes, receta, personalizado, chef_encargado, observaciones) VALUES ('$nombre_plato', '$ingredientes', '$receta', '$personalizado', '$chef_encargado', '$observaciones')";

    if ($conn->query($sql) === TRUE) {
        echo "Plato creado exitosamente.";
    } else {
        echo "Error al crear el Plato: " . $conn->error;
    }
}

$conn->close();
?>