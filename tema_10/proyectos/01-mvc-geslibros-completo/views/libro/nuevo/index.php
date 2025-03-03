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
                <form action="<?= URL ?>libro/create" method="POST">

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- Titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control" <?= isset($this->error['titulo'])? 'is-invalid': null ?> 
                            id="titulo" name="titulo"
                            placeholder="Introduzca título" value="<?= htmlspecialchars($this->libro->titulo) ?>"
                            required>
                             <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['titulo'] ??= null ?>
                        </span>
                    </div>
                        <!-- Autor -->
                        <div class="mb-3">
                            <label for="autor" class="form-label">Autor</label>
                            <?php $autores = $this->autores_id; ?>
                            <select class="form-select"  <?= (isset($this->error['autor_id']))? 'is-invalid': null ?> 
                             id="autor_id" name="autor_id" required>
                            <option selected disabled>Seleccionar autor</option>
                        
                        <!-- mostrar lista autores -->
                        <?php foreach ($this->autores_id as $indice => $data): ?>
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
                        <label for="editorial" class="form-label">Editorial</label>
                        <?php $editoriales = $this->editorial_id; ?>
                        <select class="form-select" <?= (isset($this->error['editorial_id']))? 'is-invalid': null ?> 
                        id="editorial_id" name="editorial_id">
                            <option selected disabled>Seleccionar editorial</option>
                        <!-- mostrar lista editoriales -->
                        <?php foreach ($this->editorial_id as $indice => $data): ?>
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
                        <input type="decimal" class="form-control" name="precio" <?= (isset($this->error['precio']))? 'is-invalid': null ?> 
                            id="precio" name="precio"
                            placeholder="Introduzca precio" value="<?= htmlspecialchars($this->libro->precio) ?>"
                            required>
                                <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['precio'] ??= null ?>
                        </span>
                    </div>
                    <!-- Unidades -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">Unidades</label>
                        <input type="number" class="form-control" name="stock" <?= (isset($this->error['stock']))? 'is-invalid': null ?> 
                            id="stock" name="stock"
                            placeholder="Introduzca stock" value="<?= htmlspecialchars($this->libro->stock) ?>"
                            >
                                <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['stock'] ??= null ?>
                        </span>
                    </div>

                    <!-- Fecha Edición -->
                    <div class="mb-3">
                        <label for="fecha_edicion" class="form-label">Fecha Edición</label>
                        <input type="date" class="form-control" name="fecha_edicion" <?= (isset($this->error['fecha_edicion']))? 'is-invalid': null ?> 
                            id="fecha_edicion" name="fecha_edicion"
                            placeholder="Introduzca fecha edición" value="<?= htmlspecialchars($this->libro->fecha_edicion) ?>"
                            required>
                                <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['fecha_edicion'] ??= null ?>
                        </span>
                    </div>


                    <!-- ISBN -->
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="number" class="form-control" name="isbn" <?= (isset($this->error['nombre']))? 'is-invalid': null ?> 
                            id="isbn" name="isbn"
                            placeholder="Introduzca isbn" value="<?= htmlspecialchars($this->libro->isbn) ?>"
                            required pattern="\d{13}">
                             <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['isbn'] ??= null ?>
                        </span>
                    </div>

                    <!-- Select Dinámico generos -->
                    <div class="mb-3">
                        <label for="genero" class="form-label">Seleccione Géneros</label>
                        <!-- mostrar lista asignaturas -->
                        <?php foreach ($this->generos_id as $genero => $data): ?>
                            <div class="form-control">
                                <input class="form-check-input" type="checkbox" name="generos_id[]" value="<?= $genero ?>"
                                <?= $this->libro->generos_id != null && 
                                in_array($genero, explode(',',$this->libro->generos_id)) ? 'checked' : '' ?>>
                                <label class="form-check-label" for>
                                    <?= $data ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                        </select>
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