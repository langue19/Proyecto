<!DOCTYPE html>
<html>

<head>
    <title>Escuela CEPSI</title>
    <meta charset="UTF-8">
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="FormCSS.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="shortcut icon" href="favicon/favicon-32x32.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <script src="FormJS.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
</head>

<body>


    <nav class="navreg">
        <div class="bg-dark navbar-dark" style="padding: 5px; font-size: 25px;">
            <a class="navbar-brand" href="cards.html" style="display: flex; align-items: center; justify-content:space-between;">
                <img src="conte1.png" alt="Avatar Logo" style="width: 50px;" class="rounded-pill">
                FRANCISCO JOSÉ VIANO
                <p></p>
            </a>
        </div>
    </nav>


    <div class="table-responsive-sm">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th data-column="genero">Género</th>
                    <th data-column="dni">DNI</th>
                    <th data-column="nombre">Nombre</th>
                    <th data-column="apellido">Apellido</th>
                    <th data-column="domicilio">Domicilio</th>
                    <th data-column="fecha_ingreso">Fecha Ingreso</th>
                    <th data-column="edad">Edad</th>
                    <th data-column="grado">Grado</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'crearTabla.php';

                $sql = "SELECT *
                        FROM datos_personales AS dpers
                        INNER JOIN datos_pedagogicos AS dpedg ON dpedg.Dni = dpers.Dni;
                        ";

                $consulta = $conn->prepare($sql);

                if ($consulta->execute()) {
                    while ($row = $consulta->fetch()) {

                        echo "<tr>";
                        if ($row['Sexo'] == 'Masculino') {
                            echo "<td class='sMasc'><div class='avatar'>
                        <img class='avatar__image' src='' />
                    </div></td>";
                        } elseif ($row['Sexo'] == 'Femenino') {
                            echo "<td class='sFemn'><div class='avatar'>
                        <img class='avatar__image' src='' />
                    </div></td>";
                        } else {
                            echo "<td class='sFemn'><div class='avatar'>
                        <img class='avatar__image' src='' />
                    </div></td>";
                        }
                        echo "<td>" . $row['Dni'] . "</td>";
                        echo "<td>" . $row['Nombre'] . "</td>";
                        echo "<td>" . $row['Apellido'] . "</td>";
                        echo "<td>" . $row['Domicilio'] . "</td>";
                        echo "<td>" . $row['Fecha_ingreso'] . "</td>";

                        //CALCULO DE EDAD-----------------------------
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
                        //CALCULO DE EDAD--------------------------------


                        echo "<td>" . $row['Sexo'] . "</td>";
                        echo "<td>" . "</td>";
                        echo "<td>" . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>


</body>

</html>