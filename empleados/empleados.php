<?php
//$ se utiliza para denotar una variable. Una variable es un contenedor de datos que puede almacenar diferentes tipos de información, como números, cadenas de texto, arreglos, objetos

//$servername: Contiene el nombre del servidor de la base de datos, en este caso, "localhost", que indica que la base de datos está alojada en la misma máquina donde se está ejecutando el código.
$servername = "localhost";

//$username: Contiene el nombre de usuario que se utiliza para acceder a la base de datos, en este caso, es "root", que es un usuario comúnmente utilizado por defecto en instalaciones locales.
$username = "root";

//$password: Contiene la contraseña del usuario para acceder a la base de datos. En este ejemplo, la contraseña es "Osc@r801223", pero en un entorno de producción, es importante utilizar contraseñas seguras y no utilizar contraseñas en texto plano.
$password = "Osc@r801223";


//$dbname: Contiene el nombre de la base de datos a la cual se desea conectar, en este caso, "proyecto_final". Esta es la base de datos en la cual se realizarán las operaciones CRUD (Crear, Leer, Actualizar, Eliminar) para los empleados
$dbname = "proyecto_final";

// Conexión a la base de datos
//La clase mysqli es una clase nativa de PHP que permite establecer una conexión a una base de datos MySQL y realizar operaciones como consultas SQL, inserciones, actualizaciones y eliminaciones.

//Una vez que se crea la instancia de la clase mysqli con los valores de conexión, la variable $conn representa la conexión a la base de datos, y se puede utilizar para realizar consultas y operaciones en la base de datos a través de los métodos proporcionados por la clase mysqli. Por ejemplo, se puede usar $conn->query() para ejecutar consultas SQL y $conn->close() para cerrar la conexión con la base de datos cuando ya no se necesite.
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
//En esta sección de código, se verifica si ocurrió algún error durante la conexión a la base de datos utilizando la instancia de la clase mysqli representada por la variable $conn.
//La propiedad connect_error es una propiedad de la clase mysqli que contiene el mensaje de error de conexión si ocurrió algún problema al intentar conectar con la base de datos. Si no hubo ningún error, esta propiedad será una cadena vacía.
//La condición if ($conn->connect_error) evalúa si la propiedad connect_error tiene un valor diferente de una cadena vacía, lo que indica que se produjo un error en la conexión.
//Si se detecta un error de conexión, el código dentro del bloque if se ejecuta. En este caso, se utiliza la función die() para imprimir un mensaje de error y detener la ejecución del script. El mensaje de error que se muestra es "Error de conexión:" seguido del mensaje de error específico proporcionado por la propiedad connect_error
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Operación de creación
//$_SERVER["REQUEST_METHOD"] es una variable superglobal en PHP que se utiliza para obtener el método de solicitud HTTP utilizado para acceder a la página actual. Esta variable contiene el método utilizado para realizar la solicitud al script PHP, ya sea GET, POST, PUT, DELETE u otros métodos HTTP.
//En PHP, el operador de igualdad == se utiliza para comparar si dos valores son iguales en contenido, es decir, si tienen el mismo valor, independientemente de su tipo de dato. Si los valores comparados son iguales, la expresión devuelve true, de lo contrario, devuelve false.
//En PHP, el operador && se utiliza para realizar una operación lógica de "AND" entre dos expresiones booleanas. Devuelve true si ambas expresiones son true, y devuelve false si al menos una de las expresiones es false.
//En PHP, isset es una función que se utiliza para comprobar si una variable está definida y tiene un valor distinto de null. Devuelve true si la variable existe y tiene un valor asignado, y false si la variable no está definida o tiene un valor null.
//En PHP, los corchetes [ ] se utilizan para trabajar con arreglos (arrays). Un arreglo es una colección de elementos que se almacenan en una única variable. Cada elemento en un arreglo tiene una clave (índice) y un valor asociado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_employee"])) {
   //$identificacion = $_POST["identificacion"];: Aquí se está asignando el valor del campo "identificacion" del formulario a la variable $identificacion. Esto permite acceder al valor ingresado por el usuario en el campo de identificación.
    $identificacion = $_POST["identificacion"];
    //se asigna el valor del campo "name" del formulario a la variable $name, lo que permite acceder al valor del nombre ingresado por el usuario
    $name = $_POST["name"];
    //Se asigna el valor del campo "email" del formulario a la variable $email, para acceder al valor del correo electrónico ingresado por el usuario.
    $email = $_POST["email"];
    //se asigna el valor del campo "phone" del formulario a la variable $phone, para acceder al número de teléfono ingresado por el usuario.
    $phone = $_POST["phone"];
    //se asigna el valor del campo "position" del formulario a la variable $position, para acceder al cargo ingresado por el usuario.
    $position = $_POST["position"];

    //consulta SQL para insertar datos en la tabla "employees" de la base de datos. La consulta utiliza la instrucción INSERT INTO para agregar un nuevo registro en la tabla."VALUES ('$identificacion', '$name', '$email', '$phone', '$position')": En esta parte de la consulta se especifican los valores que se van a insertar en las columnas correspondientes. Los valores están entre paréntesis y separados por comas. Cada valor es una variable de PHP que contiene la información ingresada por el usuario en el formulario y que se ha almacenado previamente en las variables $identificacion, $name, $email, $phone y $position.
    //La cláusula VALUES se utiliza para indicar los valores que se insertarán en las columnas "identificacion", "name", "email", "phone" y "position" de la tabla "employees"
    $sql = "INSERT INTO employees (identificacion, name, email, phone, position) VALUES ('$identificacion', '$name', '$email', '$phone', '$position')";

    //se ejecuta la consulta SQL utilizando el método query del objeto $conn (que representa la conexión a la base de datos). La consulta se encuentra almacenada en la variable $sql y corresponde a la instrucción para insertar el nuevo empleado con los valores proporcionados anteriormente.
    //=== TRUE: Se utiliza el operador de igualdad estricta para comparar el resultado de la consulta con el valor booleano TRUE. Esto asegura que la consulta se haya ejecutado correctamente
    //El método query es una función que se utiliza para ejecutar consultas SQL en una base de datos a través de la conexión establecida con el objeto $conn. Este método permite enviar una consulta a la base de datos y obtener los resultados de la misma.
    //La flecha -> en PHP se utiliza para acceder a métodos y propiedades de un objeto. Es parte de la sintaxis de orientación a objetos en PHP.
    //El punto (.) en el código PHP se utiliza para concatenar (unir) cadenas de texto. Cuando se coloca un punto entre dos cadenas de texto, estas se combinan en una sola cadena más larga.
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

    //El comando UPDATE es una instrucción SQL que se utiliza para modificar registros existentes en una tabla de una base de datos. Con la instrucción UPDATE, puedes cambiar los valores de una o más columnas en una o varias filas de la tabla.
    //SET se utiliza para asignar nuevos valores a las columnas existentes en una o varias filas de la tabla.
    //WHERE se utiliza en las instrucciones SQL para filtrar las filas que cumplen con una determinada condición. Se emplea principalmente en las instrucciones SELECT, UPDATE y DELETE para especificar qué filas deben ser afectadas o recuperadas.
    $sql = "UPDATE employees SET name='$name', email='$email', phone='$phone', position='$position' WHERE identificacion='$identificacion'";

    if ($conn->query($sql) === TRUE) {
        echo "Empleado actualizado exitosamente.";
    } else {
        echo "Error al actualizar el empleado: " . $conn->error;
    }
}

// Operación de eliminación
//if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_employee"])) {:
    //Se utiliza un condicional para verificar si la solicitud fue realizada mediante el método POST y si el botón "Eliminar Empleado" 
    //($_POST["delete_employee"]) fue presionado. Ambas condiciones deben ser verdaderas para que el bloque de código dentro del if se ejecute.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_employee"])) {
    
    //$identificacion = $_POST["identificacion_del"];:
//Se obtiene el valor ingresado en el campo de "identificacion_del" del formulario, que corresponde a la identificación del empleado que se desea eliminar. La variable $identificacion almacenará este valor.
    $identificacion = $_POST["identificacion_del"];

    //$sql = "DELETE FROM employees WHERE identificacion='$identificacion'";:
//Se construye una consulta SQL de tipo DELETE para eliminar un registro específico de la tabla "employees". La cláusula WHERE se utiliza para especificar qué registro(s) deben ser eliminados de la tabla. En este caso, se utiliza la columna "identificacion" para identificar el registro a eliminar, y el valor de $identificacion se utiliza en la consulta para indicar el registro exacto que se eliminará.
    $sql = "DELETE FROM employees WHERE identificacion='$identificacion'";

    //if ($conn->query($sql) === TRUE) {:
//Se ejecuta la consulta SQL utilizando $conn->query($sql). Si la consulta se ejecuta correctamente, el resultado devuelto por query() será verdadero (TRUE), lo que significa que el empleado fue eliminado exitosamente.
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
