<!doctype html>
<html lang="es">

<head>
    <!-- Frameworks bootstrap -->
    <?php include 'views/layouts/head.html'; ?>

    <title>Proyecto 36 - CRUD Libros Array</title>
</head>

<body>
    <!-- capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/header.php' ?>

        <!-- Mostrar la tabla de libros -->
        <legend>Tabla de Libros</legend>

        <!-- Menú libros  -->
        <?php include 'views/partials/m_libros.php' ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover border">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Editorial</th>
                        <th scope="col">Genero</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($libros as $registro): ?>
                        <tr class="">
                            <td><?= $registro['id'] ?></td>
                            <td><?= $registro['titulo'] ?></td>
                            <td><?= $registro['autor'] ?></td>
                            <td><?= $registro['editorial'] ?></td>
                            <td><?= $registro['genero'] ?></td>
                            <td><?= $registro['precio'] ?></td>

                            <!-- Botones de Acción -->
                            <td>
                                <!-- botón eliminar -->
                                <a href="delete.php?id=<?= $registro['id'] ?>" title="Eliminar"
                                    onclick="return confirm('Confimar elimación del libro')">
                                    <i class="bi bi-trash-fill"></i></a>

                                <!-- botón editar -->
                                <a href="edit.php?id=<?= $registro['id'] ?>" title="Editar">
                                    <i class="bi bi-pencil-square"></i></a>

                                <!-- botón  mostrar -->
                                <a href="show.php?id=<?= $registro['id'] ?>" title="Mostrar">
                                    <i class="bi bi-card-text"></i></a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">Total Libros: <?= count($libros) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Pie del documento -->
        <?php include 'views/partials/footer.php'; ?>

    </div>
    <!-- javascript bootstrap 533 -->
    <?php include 'views/layouts/javascript.html'; ?>
</body>

</html>