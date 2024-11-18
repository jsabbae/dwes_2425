<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Mostrar Profesor - CRUD Profesores </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Mostrar Profesor</legend>

        <!-- Formulario Mostrar Profesor -->
        <form>

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" name="id" value="<?= $profesor->id ?>" disabled>
            </div>


            <!-- nombre -->
            <div>
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $profesor->nombre ?>" disabled>
            </div>

            <!-- apellidos -->
            <div>
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $profesor->apellidos ?>" disabled>
            </div>

            <!-- nrp -->
            <div>
                <label for="nrp" class="form-label">Nrp</label>
                <input type="number" class="form-control" name="nrp" value="<?= $profesor->nrp ?>" disabled>
            </div>

            <!-- fecha nacimiento -->
            <div>
                <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento"
                    value="<?= $profesor->fecha_nacimiento ?>" disabled>
            </div>

            <!-- poblacion -->
            <div>
                <label for="poblacion" class="form-label">Poblacion</label>
                <input type="text" class="form-control" name="poblacion" value="<?= $profesor->poblacion ?>" disabled>
            </div>

            <!--Campo Especialidad -->
            <div>
                <label for="especialidad" class="form-label">Especialidad</label>
                <input type="text" class="form-control" name="especialidad"
                    value="<?= $especialidades[$profesor->especialidad] ?>" disabled>
            </div>

            <!-- Campo Asignaturas -->
            <div>
                <label for="asignaturas" class="form-label">Asignaturas</label>
                <input type="text" class="form-control" name="asignaturas"
                    value="<?= implode(',', $obj_tabla_profesor->mostrar_nombre_asignaturas($profesor->asignaturas)) ?>"
                    disabled>
            </div>


            <!-- botones de acción -->
             <br>
            <a class="btn btn-primary" role="button" href="index.php">Volver</a>
        </form>
        <!-- Fin formulario nuevo artículo -->

    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>