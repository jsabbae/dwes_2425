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
       }else{
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
                <!-- Formulario de libros  -->
                <form action="<?= URL ?>libro/update/<?= $this->id ?>/<?= $this->csrf_token ?>" method="POST">

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- id oculto -->
                    <!-- Tengo que pasar el id oculto para que el controlador pueda validar doblemente el id -->
                    <input type="number" class="form-control" name="id"
                        value="<?= htmlspecialchars($this->libro->id) ?>" hidden>

                    <!-- Titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['titulo'])) ? 'is-invalid' : null ?>" id="titulo" name="titulo"
                            placeholder="Introduzca titulo" value="<?= htmlspecialchars($this->libro->titulo) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['titulo'] ??= null ?>
                        </span>
                    </div>
                    <!-- Autor -->
                    <div class="mb-3">
                        <label for="autor_id" class="form-label">Autor</label>
                        <select class="form-select <?= (isset($this->error['autor_id'])) ? 'is-invalid' : null ?>"
                            name="autor_id" id="autor_id" required>
                            <option selected disabled>Seleccione autor</option>
                            <!-- mostrar lista autores -->
                            <?php foreach ($this->autores as $indice => $data): ?>
                                <option value="<?= $indice ?>" <?= $this->libro->autor_id == $indice ? 'selected' : '' ?>>
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['autor_id'] ??= null ?>
                        </span>
                    </div>

                    <!-- Editorial -->
                    <div class="mb-3">
                        <label for="editorial_id" class="form-label">Editorial</label>
                        <select class="form-select <?= (isset($this->error['editorial_id'])) ? 'is-invalid' : null ?>"
                            name="editorial_id" id="editorial_id" required>
                            <option selected disabled>Seleccione editorial</option>
                            <!-- mostrar lista editoriales -->
                            <?php foreach ($this->editoriales as $indice => $data): ?>
                                <option value="<?= $indice ?>" <?= $this->libro->editorial_id == $indice ? 'selected' : '' ?>>
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['editorial_id'] ??= null ?>
                        </span>
                    </div>

                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number"
                            class="form-control <?= (isset($this->error['precio'])) ? 'is-invalid' : null ?>"
                            name="precio" id="precio" placeholder="Introduzca precio"
                            value="<?= htmlspecialchars($this->libro->precio) ?>" step="0.01" required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['precio'] ??= null ?>
                        </span>
                    </div>

                    <!-- Unidades -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">Unidades</label>
                        <input type="number"
                            class="form-control<?= (isset($this->error['stock'])) ? 'is-invalid' : null ?>" name="stock"
                            id="stock" placeholder="Introduzca unidades"
                            value="<?= htmlspecialchars($this->libro->stock) ?>">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['stock'] ??= null ?>
                        </span>
                    </div>

                    <!-- Fecha Edición -->
                    <div class="mb-3">
                        <label for="fecha_edicion" class="form-label">Fecha Edición</label>
                        <input type="date"
                            class="form-control<?= (isset($this->error['fecha_edicion'])) ? 'is-invalid' : null ?>"
                            id="fecha_edicion" name="fecha_edicion" placeholder="Introduzca fecha edición"
                            value="<?= htmlspecialchars($this->libro->fecha_edicion) ?>" required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['fecha_edicion'] ??= null ?>
                        </span>
                    </div>

                    <!-- ISBN -->
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="number"
                            class="form-control<?= (isset($this->error['isbn'])) ? 'is-invalid' : null ?>" id="isbn"
                            name="isbn" placeholder="Introduzca ISBN" value="<?= $this->libro->isbn ?>"
                            value="<?= htmlspecialchars($this->libro->isbn) ?>" required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['isbn'] ??= null ?>
                        </span>
                    </div>

                    <!-- Select Dinámico generos -->
                    <div class="mb-3">
                        <label for="genero" class="form-label">Seleccione Géneros</label>
                        <!-- mostrar lista asignaturas -->
                        <?php
                        $generosSeleccionados = is_array($this->libro->generos_id) ? $this->libro->generos_id : explode(',', $this->libro->generos_id);
                        if (isset($_SESSION['libro']['generos_id'])) {
                            $generosSeleccionados = $_SESSION['libro']['generos_id'];
                        }
                        ?>
                        <?php foreach ($this->generos as $genero => $data): ?>
                            <div class="form-control">
                                <input class="form-check-input" type="checkbox" name="generos_id[]" value="<?= $genero ?>"
                                    <?php if (in_array($genero, $generosSeleccionados))
                                        echo 'checked'; ?>>
                                <label class="form-check-label" for>
                                    <?= $data ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                        <?= $this->error['generos_id'] ??= null ?>
                        </span>
                    </div>
            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>libro" role="button"
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