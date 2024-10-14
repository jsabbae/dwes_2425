<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actividad 3.1 - Tabla de Libros</title>

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
            <i class="bi bi-book"></i>
            <span class="fs-3">Actividad 3.1 - Tabla de Libros</span>
            <p>Gestión Tabla Libros</p>
        </header>

        <h4>Tabla libros</h4>

        <table class="table">
            <!-- Campos de la tabla libro -->
            <tr>
                <th>id</th>
                <th>Título</th>
                <th>Autor/a</th>
                <th>Género</th>
                <th>Precio</th>

            </tr>
            <tbody>
                <!-- Iterar cada libro sobre en el array -->
                <?php foreach ($libros as $libros): ?>
                    <tr>
                        <td><?= $libros['id'] ?></td>
                        <td><?= $libros['titulo'] ?></td>
                        <td><?= $libros['autor'] ?></td>
                        <td><?= $libros['genero'] ?></td>
                        <td><?= $libros['precio'] ?>€</td>
                    </tr>
                <?php endforeach; ?> <!--  Cierre de iteración -->
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