<?php
$servername = "localhost";
$username = "root";
$password = "Osc@r801223";
$dbname = "proyecto_final";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Operación de creación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_employee"])) {
    $identificacion = $_POST["identificacion"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $position = $_POST["position"];

    $sql = "INSERT INTO employees (identificacion, name, email, phone, position) VALUES ('$identificacion', '$name', '$email', '$phone', '$position')";

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

    $sql = "UPDATE employees SET name='$name', email='$email', phone='$phone', position='$position' WHERE identificacion='$identificacion'";

    if ($conn->query($sql) === TRUE) {
        echo "Empleado actualizado exitosamente.";
    } else {
        echo "Error al actualizar el empleado: " . $conn->error;
    }
}

// Operación de eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_employee"])) {
    $identificacion = $_POST["identificacion_del"];

    $sql = "DELETE FROM employees WHERE identificacion='$identificacion'";

    if ($conn->query($sql) === TRUE) {
        echo "Empleado eliminado exitosamente.";
    } else {
        echo "Error al eliminar el empleado: " . $conn->error;
    }
}

// Mostrar lista de empleados
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

// Cerrar la conexión a la base de datos
$conn->close();
?>
