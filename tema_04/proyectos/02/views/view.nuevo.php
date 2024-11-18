<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'layouts/layout.head.html' ?>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">
        <!-- Cabecera -->
        <?php include 'partials/partial.header.php' ?>
        <legend>Nuevo Alumno - CRUD Alumnos</legend>

        <!-- Añadimos el menú -->
        <?php include 'partials/partial.menu.php' ?>


        <!-- Formulario Nuevo Alumno -->
        <form action="create.php" method="POST">
            <!-- id -->
            <div class="mb-3">
                <label class="form-label">Id</label>
                <input type="number" class="form-control" name="id">
            </div>
            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos">
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <!-- Fecha de Nacimiento -->
            <div class="mb-3">
                <label class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento">
            </div>
            <!-- Curso -->
            <div class="mb-3">
                <label class="form-label">Curso Academico</label>
                <select class="form-select" name="curso">
                    <option selected disabled>Selecciona un curso academico:</option>
                    <?php foreach ($cursos as $key => $curso): ?>
                        <option value="<?= $key ?>">
                            <?= $curso ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Asignaturas -->
            <div class="mb-3">
                <label class="form-label">Asignaturas</label>
                <div class="form-control">
                    <!-- Recorre el array ($asignaturas) de cada elemento($key) -->
                    <?php foreach ($asignaturas as $key => $asignatura): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $key ?>" name="asignaturas[]">
                            <label class="form-check-label">
                                <?= $asignatura ?>
                                <label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mb-3">
                <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Añadir</button>
            </div>

        </form>
        <br>
        <br>
        <br>
        <!-- Pie de documento -->
        <?php include 'partials/partial.footer.php' ?>

    </div>


    <!-- js bootstrap 532-->
    <?php include 'layouts/layout.javascript.html' ?>
</body>

</html>