<?php

include 'conexion.php';
include 'crearBD.php';

try {
    // Crear una conexión a MySQL
    $conn = new PDO("$driver:host=$host", $usuario, $passw);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Seleccionar la base de datos
    $conn->exec("USE $dbname");

    // Consulta para crear la tabla
    $sqlCrearTabla = "CREATE TABLE Admin (
        Email VARCHAR(50) PRIMARY KEY,
        Contraseña VARCHAR(50)
      );
      
      CREATE TABLE Datos_personales (
        Dni INT PRIMARY KEY,
        Nombre VARCHAR(50),
        Apellido VARCHAR(50),
        Sexo VARCHAR(10),
        Domicilio VARCHAR(100),
        Fecha_nacimiento DATE,
        Nombre_del_tutor VARCHAR(50)
      );
      
      CREATE TABLE Datos_internacion (
        Dni INT,
        Fecha_ingreso DATE,
        Sala VARCHAR(50),
        Habitación INT,
        Cama INT,
        Fecha_salida DATE,
        PRIMARY KEY (Dni, Fecha_ingreso),
        FOREIGN KEY (Dni) REFERENCES Datos_personales(Dni)
      );
      
      CREATE TABLE Datos_pedagogicos (
        Dni INT,
        Fecha_ingreso DATE,
        escRef VARCHAR(45),
        poseeEsc VARCHAR(45),
        escComun VARCHAR(45),
        escEspecial VARCHAR(45),
        lectContinua VARCHAR(45),
        interpTextos VARCHAR(45),
        reconoceSAV VARCHAR(45),
        elabOrac VARCHAR(45),
        lectyescri VARCHAR(45),
        resuelvOpBas VARCHAR(45),
        PRIMARY KEY (Dni, Fecha_ingreso),
        FOREIGN KEY (Dni) REFERENCES Datos_personales(Dni));
      
      CREATE TABLE Datos_prof (
        Dni INT PRIMARY KEY,
        Nombre VARCHAR(50),
        Apellido VARCHAR(50)
      );
      
      
      CREATE TABLE Datos_academ (
        Dni INT,
        Fecha DATE,
        Observación VARCHAR(100),
        Contenido VARCHAR(100),
        Área_gabinete VARCHAR(50),
        PRIMARY KEY (Dni, Fecha),
        FOREIGN KEY (Dni) REFERENCES Datos_personales(Dni)
      );";
    $conn->exec($sqlCrearTabla);


    $sqlInsertar = "INSERT INTO admin(Email,Contraseña) values ('root@gmail.com','password');";

    $conn->exec($sqlInsertar);


} catch (PDOException $e) {

}
?>
