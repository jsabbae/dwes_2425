<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.partial.php' ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

        <!-- capa de mensajes -->
        <?php require_once 'template/partials/mensaje.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= $this->title ?></h5>
            </div>
            <div class="card-body">
                <!-- Formulario de libros  -->
                <form action="<?= URL ?>libro/create" method="POST">

                    <!-- Titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control" name="titulo">
                    </div>
                    <!-- Autor -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <?php $autores = $this->autores_id; ?>
                        <? php// var_dump($this) ?>
                        <select class="form-select" name="autor_id">
                            <option>Seleccionar autor</option>
                            <?php foreach ($autores as $autor_id => $autor) { ?>
                                <option value="<?= $autor_id ?>"><?= $autor ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Editorial -->
                    <div class="mb-3">
                        <label for="editorial" class="form-label">Editorial</label>
                        <?php $editoriales = $this->editorial_id; ?>
                        <select class="form-select" name="editorial_id">
                            <option>Seleccionar editorial</option>
                            <?php foreach ($editoriales as $editorial_id => $editorial) { ?>
                                <option value="<?= $editorial_id ?>"><?= $editorial ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="decimal" class="form-control" name="precio">
                    </div>
                    <!-- Unidades -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">Unidades</label>
                        <input type="number" class="form-control" name="stock">
                    </div>

                    <!-- Fecha Edición -->
                    <div class="mb-3">
                        <label for="fecha_edicion" class="form-label">Fecha Edición</label>
                        <input type="date" class="form-control" name="fecha_edicion">
                    </div>


                    <!-- ISBN -->
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="number" class="form-control" name="isbn">
                    </div>

                    <!-- Select Dinámico generos -->
                    <div class="mb-3">
                        <label for="genero" class="form-label">Seleccione Géneros</label>
                        <!-- mostrar lista asignaturas -->
                        <?php foreach ($this->generos_id as $genero => $data): ?>
                            <div class="form-control">
                                <input class="form-check-input" type="checkbox" name="generos_id[]" value="<?= $genero ?>">
                                <label class="form-check-label" for>
                                    <?= $data ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                        </select>
                    </div>
            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>libro" role="button">Cancelar</a>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            </form>
            <!-- Fin formulario nuevo libro -->
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>