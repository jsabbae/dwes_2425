<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'layouts/head.html' ?>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">
        <!-- Cabecera -->
        <?php include 'partials/header.php' ?>
        <legend>Formulario Añadir Artículo</legend>

        <!-- Añadimos el menú -->
        <?php include 'partials/menu.php' ?>


        <!-- Formulario Nuevo Artículo -->
        <form action="create.php" method="POST">
            <!-- id -->
            <div class="mb-3">
                <label class="form-label">Id</label>
                <input type="number" class="form-control" name="id">
            </div>
            <!-- descripción -->
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input type="text" class="form-control" name="descripcion">
            </div>
            <!-- Modelo -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo">
            </div>
            <!-- Marca -->
            <div class="mb-3">
                <label class="form-label">Marcas</label>
                <select class="form-select" aria-label="Default select example" name="marcas">
                    <option selected disabled>Selecciona una marca:</option>
                    <?php foreach ($marcas as $key => $marca): ?>
                        <option value="<?= $key ?>">
                            <?= $marca ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Unidades -->
            <div class="mb-3">
                <label class="form-label">Unidades</label>
                <input type="number" class="form-control" name="unidades">
                <!-- <div class="form-text">Género del libro</div> -->
            </div>
            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" class="form-control" name="precio" step="0.01">
                <!-- <div class="form-text">Introduzca Precio</div> -->
            </div>

            <!-- Categorías -->
            <div class="mb-3">
                <label class="form-label">Seleccionar Categorías</label>
                <div class="form-control">
                    <?php foreach ($categorias as $indice => $categoria): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $indice ?>" name="categorias[]">
                            <label class="form-check-label">
                                <?= $categoria ?>
                                <label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


            <div class="mb-3">
                <a class="btn btn-secondary" href="index.php" role="button">Volver</a>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Añadir</button>
            </div>

        </form>
        <br>
        <br>
        <br>
        <!-- Pie de documento -->
        <?php include 'partials/footer.php' ?>
    </div>
    <!-- js bootstrap 532-->
    <?php include 'layouts/javascript.html' ?>
</body>

</html>