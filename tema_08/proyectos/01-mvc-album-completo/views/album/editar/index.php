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

        <!-- capa errores -->
        <?php require_once 'template/partials/error.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">

                <!-- Protección ataques XSS -->
                <h5 class="card-title"><?= htmlspecialchars($this->title) ?></h5>
            </div>
            <div class="card-body">
                <!-- Formulario de albumes  -->
                <form action="<?= URL ?>album/update/<?= $this->id ?>/<?= $this->csrf_token ?>" method="POST">

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- id oculto -->
                    <!-- Tengo que pasar el id oculto para que el controlador pueda validar doblemente el id -->
                    <input type="number" class="form-control" name="id"
                        value="<?= htmlspecialchars($this->album->id) ?>" hidden>

                    <!-- Titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['titulo'])) ? 'is-invalid' : null ?>" id="titulo" name="titulo"
                            placeholder="Introduzca titulo" value="<?= htmlspecialchars($this->album->titulo) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['titulo'] ??= null ?>
                        </span>
                    </div>

                    <!-- Descripción -->
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['descripcion'])) ? 'is-invalid' : null ?>" id="descripcion"
                            name="descripcion" placeholder="Introduzca descripción"
                            value="<?= htmlspecialchars($this->album->descripcion) ?>" required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['descripcion'] ??= null ?>
                        </span>
                    </div>

                    <!-- Autor -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['autor'])) ? 'is-invalid' : null ?>" id="autor" name="autor"
                            placeholder="Introduzca autor/a" value="<?= htmlspecialchars($this->album->autor) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['autor'] ??= null ?>
                        </span>
                    </div>

                    <!-- Fecha -->
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control
                            <?= (isset($this->error['fecha'])) ? 'is-invalid' : null ?>" id="fecha" name="fecha"
                            placeholder="Introduzca fecha" value="<?= htmlspecialchars($this->album->fecha) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['fecha'] ??= null ?>
                        </span>
                    </div>

                    <!-- Lugar -->
                    <div class="mb-3">
                        <label for="lugar" class="form-label">Lugar</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['lugar'])) ? 'is-invalid' : null ?>" id="lugar" name="lugar"
                            placeholder="Introduzca lugar" value="<?= htmlspecialchars($this->album->lugar) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['lugar'] ??= null ?>
                        </span>
                    </div>

                    <!-- Categoria -->
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select class="form-control <?= (isset($this->error['categoria'])) ? 'is-invalid' : null ?>"
                            id="categoria" name="categoria" required>
                            <option selected disabled>Seleccione una categoría</option>
                            <?php foreach ($this->categorias as $categoria): ?>
                                <option value="<?= htmlspecialchars($categoria) ?>" <?= ($this->album->categoria == $categoria) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($categoria) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['categoria'] ??= null ?>
                        </span>
                    </div>

                    <!-- Etiquetas -->
                    <div class="mb-3">
                        <label for="etiquetas" class="form-label">Etiquetas</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['etiquetas'])) ? 'is-invalid' : null ?>" id="etiquetas"
                            name="etiquetas" placeholder="Introduzca etiquetas"
                            value="<?= htmlspecialchars($this->album->etiquetas) ?>">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['etiquetas'] ??= null ?>
                        </span>
                    </div>

                    <!-- Número de fotos -->
                    <div class="mb-3">
                        <label for="num_fotos" class="form-label">Número de fotos</label>
                        <input type="text" class="form-control bg-light
                            <?= (isset($this->error['num_fotos'])) ? 'is-invalid' : null ?>" id="num_fotos"
                            name="num_fotos" placeholder="Introduzca número de fotos"
                            value="<?= htmlspecialchars($this->album->num_fotos) ?>" readonly>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['num_fotos'] ??= null ?>
                        </span>
                    </div>

                    <!-- Número de visitas -->
                    <div class="mb-3">
                        <label for="num_visitas" class="form-label">Número de visitas</label>
                        <input type="number" class="form-control bg-light
                            <?= (isset($this->error['num_visitas'])) ? 'is-invalid' : null ?>" id="num_visitas"
                            name="num_visitas" placeholder="Introduzca número de visitas"
                            value="<?= htmlspecialchars($this->album->num_visitas) ?>" readonly>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['num_visitas'] ??= null ?>
                        </span>
                    </div>

                    <!-- Carpeta -->
                    <div class="mb-3">
                        <label for="carpeta" class="form-label">Carpeta</label>
                        <input type="text" class="form-control bg-light
                            <?= (isset($this->error['carpeta'])) ? 'is-invalid' : null ?>" id="carpeta" name="carpeta"
                            placeholder="Introduzca carpeta" value="<?= htmlspecialchars($this->album->carpeta) ?>"
                            readonly>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['carpeta'] ??= null ?>
                        </span>
                    </div>

            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>album" role="button"
                    onclick="return confirm('¿Estás seguro de que deseas cancelar? Se perderán los datos ingresados.')">Cancelar</a>
                <button type="reset" class="btn btn-danger">Restaurar</button>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
            </form>
            <!-- Fin formulario editar artículo -->
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>