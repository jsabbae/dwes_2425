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
        <legend></legend>Editar Artículo</legend>

        <!-- Añadimos el menú -->
        <?php include 'partials/menu.php' ?>

       
         <!--Nuevo Artículo -->
         <form action="update.php?indice=<?=$indice?>" method="POST">
         <div class="mb-3">
                <label class="form-label">id</label>
                <input type="number" class="form-control" name="id" value="<?=$articulo->getId()?>" readonly>
            </div>
            <!-- Descripción -->
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input type="text" class="form-control" name="descripcion" value="<?=$articulo->getDescripcion()?>">
            </div>
            <!-- Modelo -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo" value="<?=$articulo->getModelo()?>">
            </div>
            <!-- Marca -->
            <div class="mb-3">
                <label class="form-label">Marca</label>
                <select class="form-select" aria-label="Default select example" name="marca">
                    <?php foreach($marcas as $key => $marca): ?>
                        <option value="<?=$key?>"
                        <?=($articulo->getMarca() == $key)?'selected':null ?>
                        >
                        <?=$marca?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Unidades -->
            <div class="mb-3">
                <label class="form-label">Unidades</label>
                <input type="number" class="form-control" name="unidades" value="<?=$articulo->getUnidades()?>">
            </div>
            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" class="form-control" name="precio" step="0.01" value="<?=$articulo->getPrecio()?>">
            </div>

            <!-- Categorías -->
            <div class="mb-3">
                <label class="form-label">Seleccionar Categorías</label>
                <div class="form-control">
                    <?php foreach ($categorias as $indice => $categoria): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $indice ?>" name="categorias[]"
                            <?=(in_array($indice,$articulo->getCategorias()) ? 'checked': null)?>
                            >
                            <!--Al ser múltiples opciones, se deberan recoger dichos valores en un array-->
                            <label class="form-check-label" for="">
                                <?= $categoria ?>
                                <label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar</button>

        </form>
        <br>
        <br>
        <br>
        

    </div>
    <!-- Pie de documento -->
     <?php include 'partials/footer.php' ?>


    <!-- js bootstrap 532-->
    <?php include 'layouts/javascript.html' ?>
</body>

</html>