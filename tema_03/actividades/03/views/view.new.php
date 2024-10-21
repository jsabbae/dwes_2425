<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto 33 - Añadir funcionalidad - Añadir Libro</title>

    <!-- css bootstrap 533 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- bootstrap icons 1.11.3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <span class="fs-5">
                <i class="bi bi-people-fill"></i>
                Proyecto 33 - Añadir funcionalidad - Añadir Libro
            </span>
        </header>

        <!-- Mostrar la tabla de alumnos -->
        <legend>Formulario Añadir libro</legend>

        <!-- Formulario Nuevo alumno -->
        <form action="create.php" method="POST">

            <!-- id -->
            <div class="mb-3 row">
                <label for="inputid" class="col-sm-2 col-form-label">Id:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputid" name="id">
                </div>
            </div>
            <!-- titulo -->
            <div class="mb-3 row">
                <label for="inputtitulo" class="col-sm-2 col-form-label">Título:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputtitulo" name="titulo">
                </div>
            </div>
            <!-- autor  -->
            <div class="mb-3 row">
                <label for="inputautor" class="col-sm-2 col-form-label">Autor:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputautor" name="autor">
                </div>
            </div>
            <!-- genero  -->
            <div class="mb-3 row">
                <label for="inputgenero" class="col-sm-2 col-form-label">Genero:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputgeneroo" name="genero">
                </div>
            </div>
            <!-- precio  -->
            <div class="mb-3 row">
                <label for="inputprecio" class="col-sm-2 col-form-label">Precio:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputprecio" name="precio">
                </div>
            </div>

            <!-- botones de acción -->

            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>
        <!-- fin formulario -->


        <!-- Pie del documento -->
        <footer class="footer mt-auto py-3 fixed-bottom bg-light">
            <div class="container">
                <span class="text-muted">© 2024
                    Juan Manuel Saborido Baena - DWES - 2º DAW - Curso 24/25</span>
            </div>
        </footer>

    </div>
    <!-- javascript bootstrap 533 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>