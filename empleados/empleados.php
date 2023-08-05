<?php
$servername = "localhost";
$username = "root";
$password = "Osc@r801223";
$dbname = "proyecto_final";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_employee"])) {
   
    $identificacion = $_POST["identificacion"];
    
    $name = $_POST["name"];
    
    $email = $_POST["email"];
    
    $phone = $_POST["phone"];
    
    $position = $_POST["position"];

    
    $sql = "INSERT INTO employees (identificacion, name, email, phone, position) VALUES ('$identificacion', '$name', '$email', '$phone', '$position')";

    os cadenas de texto, estas se combinan en una sola cadena más larga.
    if ($conn->query($sql) === TRUE) {
        echo "Empleado creado exitosamente.";
    } else {
        echo "Error al crear el empleado: " . $conn->error;
    }
}

// Operación de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_employee"])) {
    $identificacion = $_POST["identificacion_mod"];
    $name = $_POST["name_mod"];
    $email = $_POST["email_mod"];
    $phone = $_POST["phone_mod"];
    $position = $_POST["position_mod"];

    

    if ($conn->query($sql) === TRUE) {
        echo "Empleado actualizado exitosamente.";
    } else {
        echo "Error al actualizar el empleado: " . $conn->error;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_employee"])) {
    
 
    $identificacion = $_POST["identificacion_del"];

    if ($conn->query($sql) === TRUE) {
        echo "Empleado eliminado exitosamente.";
    } else {
        echo "Error al eliminar el empleado: " . $conn->error;
    }
}


$sql = "SELECT * FROM employees";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        
        echo "Identificación: " . $row["identificacion"] . "<br>";
        echo "Nombre: " . $row["name"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "Teléfono: " . $row["phone"] . "<br>";
        echo "Cargo: " . $row["position"] . "<br>";
      
        echo "<hr>";
    }
} else {
    echo "No se encontraron empleados.";
}


$conn->close();
?>
