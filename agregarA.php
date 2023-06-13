<?php

include 'conexion.php';
include 'crearBD.php';
include 'crearTabla.php';

$dni = $_POST['documento'];
$nomb = $_POST['nombre'];
$ape = $_POST['apellido'];
$genero = $_POST['genero'];
$dom = $_POST['domicilio'];
$fecha_nac = $_POST['fecha_nacimiento'];
$nombTutor = $_POST['nombre_tutor'];

$conn->exec("USE $dbname");

$stmt = $conn->prepare("INSERT INTO Datos_personales(Dni, Nombre, Apellido, Sexo, Domicilio, Fecha_nacimiento, Nombre_del_tutor) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$dni, $nomb, $ape, $genero, $dom, $fecha_nac, $nombTutor]);

$fecha_ing= $_POST['fecha_ingreso'];
$escRef = $_POST['escRef'];
$poseEsc = $_POST['posE'];
$escComun = $_POST['escC'];
$escEspec = $_POST['escE'];
$LecturaCont = $_POST['lectC'];
$InterpText = $_POST['interpT'];
$ReconoceASV = $_POST['reconcSAV'];
$ElabOrac = $_POST['elabO'];
$lectYesct = $_POST['LectyEsc'];
$resOpBasic = $_POST['resOpBasc'];


$stmt = $conn->prepare("INSERT INTO Datos_pedagogicos(Dni, Fecha_ingreso, escRef, poseeEsc, escComun, escEspecial, lectContinua, interpTextos, reconoceSAV, elabOrac, lectyescri, resuelvOpBas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->execute([$dni, $fecha_ing, $escRef, $poseEsc, $escComun, $escEspec, $LecturaCont, $InterpText, $ReconoceASV, $ElabOrac, $lectYesct, $resOpBasic]);

$sala=$_POST['sala'];
$habitacion=$_POST['habitacion'];
$cama=$_POST['cama'];
$fecha_alta=$_POST['fecha_alta'];
$stmt = $conn->prepare("INSERT INTO Datos_internacion(Dni, Fecha_ingreso, Sala, Habitación, Cama, Fecha_salida) VALUES (?, ?, ?, ?, ?, ?)");

$stmt->execute([$dni, $fecha_ing, $sala, $habitacion, $cama, $fecha_alta]);

header("location: cards.html");
?>