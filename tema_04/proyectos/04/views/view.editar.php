<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Editar Profesor - CRUD Profesores </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Editar Profesor</legend>

        <!-- Formulario Editar Profesor -->
        <form action="update.php?indice=<?= $indice ?>" method="POST">

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" name="id" value="<?= $profesor->id ?>" readonly>
            </div>


            <!-- nombre -->
            <div>
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $profesor->nombre ?>">
            </div>

            <!-- apellidos -->
            <div>
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $profesor->apellidos ?>">
            </div>

            <!-- nrp -->
            <div>
                <label for="nrp" class="form-label">Nrp</label>
                <input type="number" class="form-control" name="nrp" value="<?= $profesor->nrp ?>">
            </div>

            <!-- fecha nacimiento -->
            <div>
                <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento"
                    value="<?= $profesor->fecha_nacimiento ?>">
            </div>

            <!-- poblacion -->
            <div>
                <label for="poblacion" class="form-label">Poblacion</label>
                <input type="text" class="form-control" name="poblacion" value="<?= $profesor->poblacion ?>">
            </div>

            <!-- Select Dinámico Especialidades -->
            <div class="mb-3">
                <label for="asignaturas" class="form-label">Especialidad</label>
                <select class="form-select" name="especialidad" id="especialidad">
                    <!-- <option>Selecciona una Especialidad</option> -->
                    <!-- Mostrar lista especialidades -->
                    <?php foreach ($especialidades as $indice => $data): ?>
                        <option value="<?= $indice ?>" <?= ($profesor->especialidad == $indice) ? 'selected' : null ?>
                            >
                            <?= $data ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Lista checkbox dinámico asignaturas -->
            <div class="mb-3">
                <label for="asignaturas" class="form-label">Selecciona las Asignaturas</label>
                <div class="form-control">
                    <?php foreach ($asignaturas as $indice => $data): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="asignaturas[]" value="<?= $indice ?>"
                                <?= in_array($indice, $profesor->asignaturas) ? 'checked' : null ?>>
                            <label class="form-check-label" for="">
                                <?= $data ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" role="button" href="index.php">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
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