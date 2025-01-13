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
                <!-- Enviar al controlador update con el id del libro -->
                <form action="<?= URL ?>libro/update/<?= $this->id ?>" method="POST">

                    <!-- id oculto -->
                    <!-- Tengo que pasar el id oculto para que el controlador pueda validar doblemente el id -->
                    <input type="number" class="form-control" name="id" value="<?= $this->libro->id ?>" hidden>

                    <!-- Titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control" name="titulo" value="<?= $this->libro->titulo ?>">
                    </div>
                    <!-- Autor -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <select class="form-select" name="autor_id">
                            <!-- mostrar lista autores -->
                            <?php foreach ($this->autores as $indice => $data): ?>
                                <option value="<?= $indice ?>" <?php if ($indice == $this->libro->autor_id)
                                      echo 'selected' ?>>
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Editorial -->
                    <div class="mb-3">
                        <label for="editorial" class="form-label">Editorial</label>
                        <select class="form-select" name="editorial_id">
                            <!-- mostrar lista editoriales -->
                            <?php foreach ($this->editoriales as $indice => $data): ?>
                                <option value="<?= $indice ?>" <?php if ($indice == $this->libro->editorial_id)
                                      echo 'selected' ?>>
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" name="precio" value="<?= $this->libro->precio ?>">
                    </div>
                    <!-- Unidades -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">Unidades</label>
                        <input type="number" class="form-control" name="stock" value="<?= $this->libro->stock ?>">
                    </div>

                    <!-- Fecha Edición -->
                    <div class="mb-3">
                        <label for="fecha_edicion" class="form-label">Fecha Edición</label>
                        <input type="date" class="form-control" name="fecha_edicion"
                            value="<?= $this->libro->fecha_edicion ?>">
                    </div>

                    <!-- ISBN -->
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" name="isbn" value="<?= $this->libro->isbn ?>">
                    </div>

                    <!-- Select Dinámico Generos -->
                    <div class="mb-3">
                        <label for="genero" class="form-label">Género</label>
                        <!-- mostrar lista generos -->
                         <?php $generos_id = explode(",", $this->libro->generos_id) ?>
                        <?php foreach ($this->generos as $indice => $data): ?>
                            <div class="form-control">
                                <input class="form-check-input" name="generos_id[]" type="checkbox" value="<?= $indice ?>" 
                                <?php if(in_array($indice,$generos_id))
                                echo "checked" ?>>
                                <label class="form-check-label" for>
                                    <?= $data ?>
                                </label>
                            </div>

                        <?php endforeach; ?>
                    </div>
            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>libro" role="button">Cancelar</a>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
            </form>
            <!-- Fin formulario nuevo artículo -->
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>