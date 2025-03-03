<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
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
                <!-- Formulario de albumes -->
                <form>

                    <!-- id -->
                    <div class="mb-3">
                        <label for="id" class="form-label">Id</label>
                        <input type="number" class="form-control" value="<?= $this->album->id ?>" disabled>
                    </div>

                    <!-- Titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control" value="<?= $this->album->titulo ?>" disabled>
                    </div>

                    <!-- Descripcion -->
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" value="<?= $this->album->descripcion ?>" disabled>
                    </div>

                    <!-- Autor -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <input type="text" class="form-control" value="<?= $this->album->autor ?>" disabled>
                    </div>

                    <!-- Fecha -->
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" value="<?= $this->album->fecha ?>" disabled>
                    </div>

                    <!-- Lugar -->
                    <div class="mb-3">
                        <label for="lugar" class="form-label">Lugar</label>
                        <input type="text" class="form-control" value="<?= $this->album->lugar ?>" disabled>
                    </div>

                    <!-- Categoria -->
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <input type="text" class="form-control" value="<?= $this->album->categoria ?>" disabled>
                    </div>

                    <!-- Etiquetas -->
                    <div class="mb-3">
                        <label for="etiquetas" class="form-label">Etiquetas</label>
                        <input type="text" class="form-control" value="<?= $this->album->etiquetas ?>" disabled>
                    </div>

                    <!-- Número de fotos -->
                    <div class="mb-3">
                        <label for="num_fotos" class="form-label">Número de fotos</label>
                        <input type="number" class="form-control" value="<?= $this->album->num_fotos ?>" disabled>
                    </div>

                    <!-- Número de visitas -->
                    <div class="mb-3">
                        <label for="num_visitas" class="form-label">Número de visitas</label>
                        <input type="number" class="form-control" value="<?= $this->album->num_visitas ?>" disabled>
                    </div>

                    <!-- Carpeta -->
                    <div class="mb-3">
                        <label for="carpeta" class="form-label">Carpeta</label>
                        <input type="text" class="form-control" value="<?= $this->album->carpeta ?>" disabled>
                    </div>

                    <!-- Muestra la imagen subida -->
                    <?php
                    // Si la carpeta $album->carpeta no esta vacia, hay que almacenar todos los nombre de imagenes en $this->album->imagen
                    if (!empty('imagenes/' . $this->album->carpeta)) {
                        $this->album->imagen = scandir('imagenes/' . $this->album->carpeta);
                        // Eliminar los dos primeros elementos del array
                        array_shift($this->album->imagen);
                        array_shift($this->album->imagen);
                    }
                    ?>


                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen/es</label>
                        <div>
                            <?php if (!empty($this->album->imagen)): ?>

                                <?php foreach ($this->album->imagen as $imagen): ?>
                                    <img src="<?= URL ?>imagenes/<?= $this->album->carpeta ?>/<?= $imagen ?>"
                                        class="img-thumbnail d-inline-block m-1" style="width: 22%;"
                                         alt="<?= $imagen ?>">
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No hay imagen disponible</p>
                            <?php endif; ?>
                        </div>
                    </div>



            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>album" role="button">Volver</a>
            </div>
            </form>
            <!-- Fin formulario nuevo album -->
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>