<?php

include 'conexion.php';
include 'crearBD.php';
include 'crearTabla.php';

$user = $_POST['user'];
$pwd = $_POST['psw'];


try {
// Ejecutar la consulta SQL
$stmt = $conn->query("SELECT * FROM admin");
    
// Verificar si se obtuvieron resultados
if ($stmt->rowCount() > 0) {
    // Procesar los datos obtenidos
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Acceder a los valores de cada fila
        $user1 = $row["Email"];
        $psw1 = $row["Contraseña"];

        if ($user === $user1 && $pwd === $psw1) {
            header("location: cards.html");
            exit();
        } else {
            header("location: /Proyecto-master/login.html");
        }

        // Hacer algo con los datos obtenidos
        echo "Email: " . $user . ", password: " . $psw . "<br>";
    }
}
} catch (PDOException $e) {
// Manejar errores de conexión o consulta
echo "Error: " . $e->getMessage();
}

?>