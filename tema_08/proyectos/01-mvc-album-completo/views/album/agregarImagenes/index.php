<!doctype html>
<html lang="en">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?></title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php
    if (!isset($_SESSION['user_id'])) {
        require_once 'template/partials/menu.partial.php';
    } else {
        require_once 'template/partials/menu.auth.partial.php';
    }
    ?>
    <br><br><br>

    <!-- Capa Principal -->
    <div class="container">

        <!-- Capa de errores -->
        <?php require_once 'template/partials/error.partial.php' ?>

        <!-- Capa de mensajes -->
        <?php require_once 'template/partials/mensaje.partial.php' ?>

        <legend>Formulario Subida de imágenes</legend>

        <form method="POST" enctype="multipart/form-data" action="<?= URL ?>/album/upload/<?= $this->id ?>">

            <!-- protección CSRF -->
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">


            <!-- Validación tamaño 5 MB-->
            <input type="hidden" name="MAX_FILE_SIZE" value="5242880">

            <!-- Seleccionador de imágenes -->
            <div class="mb-3">
                <label for="formFile" class="form-label">Seleccione imagen</label>
                <input type="file" class="form-control" name="ficheros[]" id="formFile" value="<?= $ficheros ?>"
                    multiple accept=".jpg, .gif, .png">
                <!-- errores -->
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['fichero'] ??= null ?>
                </span>
            </div>
            <!-- Botones de acción -->
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Enviar</button>
            </div>
        </form>
    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>
</body>

</html>