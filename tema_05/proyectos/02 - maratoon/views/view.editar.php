<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Editar Corredor - BBDD maratoon </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Edición Corredor</legend>

        <!-- Formulario Nuevo libro -->

        <form action="update.php?id=<?= $id ?>" method="POST">

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $corredor->nombre ?>">
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $corredor->apellidos ?>">
            </div>
            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fechaNacimiento"
                    value="<?= $corredor->fechaNacimiento ?>">
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $corredor->email ?>">
            </div>

            <!-- Dni -->
            <div class="mb-3">
                <label for="dni" class="form-label">Dni</label>
                <input type="text" class="form-control" name="dni" value="<?= $corredor->dni ?>">
            </div>

            <!-- Select Dinámico Categorias -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" name="id_categoria">
                    <option selected disabled>Seleccione categoria</option>
                    <!-- mostrar lista cucrsos -->
                    <?php foreach ($categorias as $data): ?>
                        <!-- generar dinámicamente el parametro selected -->
                        <option value="<?= $data['id'] ?>" <?= ($corredor->id_categoria == $data['id']) ? 'selected' : null ?>>
                            <?= $data['categoria'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="club" class="form-label">Club</label>
                <select class="form-select" name="id_club">
                    <option selected disabled>Seleccione club</option>
                    <!-- mostrar lista cucrsos -->
                    <?php foreach ($clubs as $data): ?>
                        <!-- generar dinámicamente el parametro selected -->
                        <option value="<?= $data['id'] ?>" <?= ($corredor->id_club == $data['id']) ? 'selected' : null ?>>
                            <?= $data['club'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>


            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
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