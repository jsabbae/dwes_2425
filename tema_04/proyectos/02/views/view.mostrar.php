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
        <legend>Mostrar Alumno - CRUD Alumnos</legend>

        <!-- Añadimos el menú -->
        <?php include 'partials/partial.menu.php' ?>


        <!-- Formulario Mostrar Alumno -->
        <form>
            <!-- id -->
            <div class="mb-3">
                <label class="form-label">id</label>
                <input type="text" class="form-control" value="<?= $alumno->id ?>" disabled>
            </div>
            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" value="<?= $alumno->nombre ?>" disabled>
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Apellidos</label>
                <input type="text" class="form-control" value="<?= $alumno->apellidos ?>" disabled>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" value="<?= $alumno->email ?>" disabled>
            </div>

            <!-- Edad -->
            <div class="mb-3">
                <label class="form-label">Edad</label>
                <input type="text" class="form-control" value="<?= $alumno->getEdad() ?>" disabled>
            </div>

            <!-- Curso -->
            <div class="mb-3">
                <label class="form-label">Curso</label>
                <input type="text" class="form-control" value="<?= $cursos[$alumno->curso] ?>" disabled>
            </div>
            <!-- Asignaturas -->
            <div class="mb-3">
                <label for="precio" class="form-label">Asignaturas</label>
                <input type="text" class="form-control"
                    value="<?= implode(', ', Class_tabla_alumnos::mostrarAsignaturas($asignaturas, $alumno->asignaturas)) ?>"
                    disabled>
            </div>

            <!-- Botón volver (Puede que tenga que disminuir la pantalla por que lo tapa el pie de página)  -->
            <a class="btn btn-secondary" href="index.php" role="button">Volver</a>
        </form>


    </div>
    <!-- Pie de documento -->
    <?php include 'partials/partial.footer.php' ?>


    <!-- js bootstrap 532-->
    <?php include 'layouts/layout.javascript.html' ?>
</body>

</html>