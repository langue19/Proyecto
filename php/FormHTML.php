<!DOCTYPE html>
<html>

<head>
    <title>Escuela CEPSI</title>
    <meta charset="UTF-8">
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="/Proyecto-master/css/FormCSS.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="shortcut icon" href="/Proyecto-master/favicon/favicon-32x32.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <script src="/Proyecto-master/js/FormJS.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>
</head>

<body>

    <nav class="navreg">
        <div class="bg-dark navbar-dark" style="padding: 5px; font-size: 25px;">
            <a class="navbar-brand" href="/Proyecto-master/php/cards.html" style="display: flex; align-items: center; justify-content:space-between;">
                <img src="/Proyecto-master/img/conte1.png" alt="Avatar Logo" style="width: 50px;" class="rounded-pill">
                FRANCISCO JOSÉ VIANO
                <p></p>
            </a>
        </div>
    </nav>


    <div class="container">
        <!--  Search Bar  -->
        <div class="form-control">
            <label for="search"><i class="icon-search"></i></label>
            <input class="table-filter" type="search" data-table="advanced-web-table" placeholder="Buscar...">
        </div>
        <!--  Table  -->
        <div class="table-responsive">
            <table id="ordering-table" class="advanced-web-table">
                <thead>
                    <tr>
                        <th>Género</th>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha Ingreso</th>
                        <th>Edad</th>
                        <th>Grado</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
include 'crearTabla.php';

$sql = "SELECT *
        FROM datos_personales AS dpers
        INNER JOIN datos_pedagogicos AS dpedg ON dpedg.Dni = dpers.Dni;";

$consulta = $conn->prepare($sql);

if ($consulta->execute()) {
    while ($row = $consulta->fetch()) {
        echo "<tr>";
        if ($row['Sexo'] == 'Masculino') {
            echo "<td>
                    <div class='avatar'>
                        <img class='avatar__image' src='/Proyecto-master/img/gmujer.png' />
                    </div>
                </td>";
        } elseif ($row['Sexo'] == 'Femenino') {
            echo "<td>
                    <div class='avatar'>
                        <img class='avatar__image' src='/Proyecto-master/img/ghombre.png' />
                    </div>
                </td>";
        }
        echo "<td>" . $row['Dni'] . "</td>";
        echo "<td>" . $row['Nombre'] . "</td>";
        echo "<td>" . $row['Apellido'] . "</td>";
        echo "<td>" . $row['Fecha_ingreso'] . "</td>";

        // CALCULO DE EDAD-----------------------------
        $consultaEdad = "SELECT TIMESTAMPDIFF(YEAR, Fecha_nacimiento, CURDATE()) AS edad FROM datos_personales WHERE Dni = :dni";
        $stmtEdad = $conn->prepare($consultaEdad);
        $stmtEdad->bindParam(':dni', $row['Dni']);
        $stmtEdad->execute();
        // Verificar si se obtuvieron resultados
        if ($stmtEdad) {
            // Obtener el resultado de la consulta
            $resultadoEdad = $stmtEdad->fetch(PDO::FETCH_ASSOC);
        }
        echo "<td>" . $resultadoEdad['edad'] . "</td>";
        // CALCULO DE EDAD--------------------------------

        echo "<td>" . $row['Grado'] . "</td>";
        echo "<td>
                <div class='w3-container'>
                    <button onclick=\"document.getElementById('id-" . $row['Dni'] . "').style.display='block'\" class='w3-button w3-black'>Datos</button>
                    <div id='id-" . $row['Dni'] . "' class='w3-modal'>
                        <div class='w3-modal-content w3-card-4 w3-animate-zoom'>
                            <header class='w3-container w3-blue'> 
                                <span onclick=\"document.getElementById('id-" . $row['Dni'] . "').style.display='none'\" 
                                    class='w3-button w3-blue w3-xlarge w3-display-topright'>&times;</span>
                                <h2>Header</h2>
                            </header>
                            <div class='w3-bar w3-border-bottom'>
                                <button class='tablink w3-bar-item w3-button' onclick=\"openCity(event, 'London-" . $row['Dni'] . "')\">Datos Personales</button>
                                <button class='tablink w3-bar-item w3-button' onclick=\"openCity(event, 'Paris-" . $row['Dni'] . "')\">Datos Pedagogicos</button>
                                <button class='tablink w3-bar-item w3-button' onclick=\"openCity(event, 'Tokyo-" . $row['Dni'] . "')\">Datos Internacion</button>
                            </div>
                            <div id='London-" . $row['Dni'] . "' class='w3-container city'>
                                <div class='container'>
                                    <div class='form-control'>
                                        <label for='search'><i class='icon-search'></i></label>
                                        <input class='table-filter' type='search' data-table='advanced-web-table' placeholder='Buscar...'>
                                    </div>
                                    <!--  Table  -->
                                    <div class='table-responsive'>
                                        <table id='ordering-table' class='advanced-web-table'>
                                            <thead>
                                                <tr>
                                                    <th>DNI</th>
                                                    <th>Apellido</th>
                                                    <th>Nombre</th>
                                                    <th>Genero</th>
                                                    <th>Domicilio</th>
                                                    <th>Fecha nacimiento</th>
                                                    <th>Nombre del Tutor</th>
                                                    <th>Edad</th>
                                                </tr>
                                            </thead>
                                            <tbody>";

        $dniviejo = $row['Dni'];

        $sql2 = "SELECT *
                FROM datos_personales WHERE $dniviejo = Dni;";

        $consulta2 = $conn->prepare($sql2);

        if ($consulta2->execute()) {
            while ($row2 = $consulta2->fetch()) {
                echo "<tr>";
                echo "<td>" . $row2['Dni'] . "</td>";
                echo "<td>" . $row2['Apellido'] . "</td>";
                echo "<td>" . $row2['Nombre'] . "</td>";
                echo "<td>" . $row2['Sexo'] . "</td>";
                echo "<td>" . $row2['Domicilio'] . "</td>";
                echo "<td>" . $row2['Fecha_nacimiento'] . "</td>";
                echo "<td>" . $row2['Nombre_del_tutor'] . "</td>";

                // CALCULO DE EDAD-----------------------------
                $consultaEdad2 = "SELECT TIMESTAMPDIFF(YEAR, Fecha_nacimiento, CURDATE()) AS edad FROM datos_personales WHERE Dni = :dni";
                $stmtEdad2 = $conn->prepare($consultaEdad2);
                $stmtEdad2->bindParam(':dni', $row2['Dni']);
                $stmtEdad2->execute();
                // Verificar si se obtuvieron resultados
                if ($stmtEdad2) {
                    // Obtener el resultado de la consulta
                    $resultadoEdad2 = $stmtEdad2->fetch(PDO::FETCH_ASSOC);
                }
                echo "<td>" . $resultadoEdad2['edad'] . "</td>";
                // CALCULO DE EDAD--------------------------------
                echo "</tr>";
            }
        }

        echo "</tbody>
                </table>
            </div>
        </div>
    </div>

    <div id='Paris-" . $row['Dni'] . "' class='w3-container city'>
        <div class='container'>
            <div class='form-control'>
                <label for='search'><i class='icon-search'></i></label>
                <input class='table-filter' type='search' data-table='advanced-web-table' placeholder='Buscar...'>
            </div>
            <!--  Table  -->
            <div class='table-responsive'>
                <table id='ordering-table' class='advanced-web-table'>
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>Fecha de ingreso</th>
                            <th>Escuela de referencia</th>
                            <th>Grado</th>
                            <th>Posee Escolaridad?</th>
                            <th>Escuela comun?</th>
                            <th>Escuela especial?</th>
                            <th>Lectura continua?</th>
                            <th>Interpreta textos?</th>
                            <th>Reconoce sustantivos, adjetivos y/o verbos?</th>
                            <th>Elabora oraciones?</th>
                            <th>Lectura y escritura?</th>
                            <th>Resuelve operaciones basicas?</th>
                        </tr>
                    </thead>
                    <tbody>";

        $dniviejo = $row['Dni'];

        $sql2 = "SELECT *
                FROM datos_pedagogicos WHERE $dniviejo = Dni;";

        $consulta2 = $conn->prepare($sql2);

        if ($consulta2->execute()) {
            while ($row2 = $consulta2->fetch()) {
                echo "<tr>";
                echo "<td>" . $row2['Dni'] . "</td>";
                echo "<td>" . $row2['Fecha_ingreso'] . "</td>";
                echo "<td>" . $row2['escRef'] . "</td>";
                echo "<td>" . $row2['Grado'] . "</td>";
                echo "<td>" . $row2['poseeEsc'] . "</td>";
                echo "<td>" . $row2['escComun'] . "</td>";
                echo "<td>" . $row2['escEspecial'] . "</td>";
                echo "<td>" . $row2['lectContinua'] . "</td>";
                echo "<td>" . $row2['interpTextos'] . "</td>";
                echo "<td>" . $row2['reconoceSAV'] . "</td>";
                echo "<td>" . $row2['elabOrac'] . "</td>";
                echo "<td>" . $row2['lectyescri'] . "</td>";
                echo "<td>" . $row2['resuelvOpBas'] . "</td>";
                echo "</tr>";
            }
        }

        echo "</tbody>
                </table>
            </div>
        </div>
    </div>

    <div id='Tokyo-" . $row['Dni'] . "' class='w3-container city'>
        <div class='form-control'>
            <label for='search'><i class='icon-search'></i></label>
            <input class='table-filter' type='search' data-table='advanced-web-table' placeholder='Buscar...'>
        </div>
        <!--  Table  -->
        <div class='table-responsive'>
            <table id='ordering-table' class='advanced-web-table'>
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Fecha de ingreso</th>
                        <th>Fecha de salida</th>
                        <th>Sala</th>
                        <th>Habitacion</th>
                        <th>Cama</th>
                    </tr>
                </thead>
                <tbody>";

        $dniviejo = $row['Dni'];

        $sql2 = "SELECT *
                FROM datos_internacion WHERE $dniviejo = Dni;";

        $consulta2 = $conn->prepare($sql2);

        if ($consulta2->execute()) {
            while ($row2 = $consulta2->fetch()) {
                echo "<tr>";
                echo "<td>" . $row2['Dni'] . "</td>";
                echo "<td>" . $row2['Fecha_ingreso'] . "</td>";
                echo "<td>" . $row2['Fecha_salida'] . "</td>";
                echo "<td>" . $row2['Sala'] . "</td>";
                echo "<td>" . $row2['Habitación'] . "</td>";
                echo "<td>" . $row2['Cama'] . "</td>";
                echo "</tr>";
            }
        }

        echo "</tbody>
            </table>
        </div>
    </div>

    </div>
    </div>
    </td>";
    echo "</tr>";
}}
?>

                </tbody>
            </table>
        </div>
    </div>




</body>

</html>