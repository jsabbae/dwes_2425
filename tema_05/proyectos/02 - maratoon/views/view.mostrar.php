<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Mostrar Corredores - CRUD Corredores </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Mostrar Corredor</legend>

        <!-- Formulario Nuevo corredor -->

        <form>

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" name="id" value="<?= $corredor->id ?>" disabled>
            </div>

            <!-- nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $corredor->nombre ?>" disabled>
            </div>

            <!-- apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $corredor->apellidos ?>" disabled>
            </div>

            <!-- ciudad -->
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="<?= $corredor->ciudad ?>" disabled>
            </div>

            <!-- sexo -->
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <input type="text" class="form-control" name="sexo" value="<?= $corredor->sexo ?>" disabled>
            </div>

            <!-- email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" value="<?= $corredor->email ?>" disabled>
            </div>

            <!-- fechaNacimiento -->
            <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fechaNacimiento" value="<?= $corredor->fechaNacimiento ?>"
                    disabled>
            </div>

            <!-- Dni -->
            <div class="mb-3">
                <label for="dni" class="form-label">Dni</label>
                <input type="text" class="form-control" name="dni" value="<?= $corredor->dni ?>" disabled>
            </div>

            <!-- Categorias -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <input type="text" class="form-control" name="categoria" value="<?= $corredor->categoria ?>" disabled>
            </div>

            <!-- Clubs -->
            <div class="mb-3">
                <label for="club" class="form-label">Club</label>
                <input type="text" class="form-control" name="club" value="<?= $corredor->club?>" disabled>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>

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