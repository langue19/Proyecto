<?php
include 'conexion.php';

try {
    // Crear una conexión a MySQL
    $conn = new PDO("$driver:host=$host", $usuario, $passw);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para crear la base de datos
    $sql = "CREATE DATABASE $dbname";
    $conn->exec($sql);
    
} catch (PDOException $e) {

}

try {
    // Crear una conexión a MySQL
    $conn = new PDO("$driver:host=$host", $usuario, $passw);

    // Nombre de la base de datos a verificar

    // Consulta para obtener la lista de bases de datos
    $sql = "SHOW DATABASES";
    $stmt = $conn->query($sql);

    // Verificar si la base de datos existe en la lista
    $databaseExists = false;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['Database'] === $dbname) {
            $databaseExists = true;
            break;
        }
    }

    if ($databaseExists) {
    } else {
    }
} catch (PDOException $e) {

}
?>
