<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actividad 3.2 - Tabla de multiplicar</title>

    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap Icons 1.11.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-table 3x3"></i>
            <span class="fs-3">Actividad 3.2 - Tabla de multiplicar</span>
            <i class="bi bi-123 3x3"></i>
        </header>

        <h4>Tabla libros</h4>
        <!-- Tabla y color de la tabla -->
        <table class="table table-bordered table-striped table-primary">

            <!-- Filas de la tabla de multiplicar -->
            <tbody>
                <th></th> <!-- Columna vacia que hace de espacio -->
                <?php
                //  i = 1 porque empezamos en la multiplicación del 1
                for ($i = 1; $i <= 10; $i++) {        //  Columnas de la tabla de multiplicar
                    echo "<th>$i</th>";               //  Encabezado de cada fila en negrita
                
                }


                for ($j = 1; $j <= 10; $j++) {     //  Filas de la tabla de multiplicar
                    echo "<tr>";
                    echo "<th>$j</th>"; //  Encabezado de cada fila en negrita
                
                    //  Multiplicación de todas las celdas del 1 al 10
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<td>";
                        $celdas = $i * $j;  //  Al sesr un array bidimensional multiplica filas por columnas
                        echo "$celdas";
                        echo "</td>";
                    }
                    echo "</tr>";

                }

                ?>
            </tbody>
        </table>
    </div>


    <!-- Pie del documento -->
    <footer class="footer mt-auto py-3 fixed-bottom bg-light">
        <div class="container">
            <span class="text-muted">© 2024
                Juan Manel Saborido Baena - DWES - 2º DAW - Curso 24/25</span>
        </div>
    </footer>

    <!-- Bootstrap Javascript y popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>