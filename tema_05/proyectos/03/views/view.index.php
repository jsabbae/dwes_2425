<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Panel de Control de Gesbank - Home </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>


        <!-- Menú principal -->
        <?php include 'views/partials/partial.menu.php'; ?>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <tr>
                        <th>Id</th>
                        <th>Apellidos</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Ciudad</th>
                        <th>DNI</th>
                        <th>Email</th>
                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <?php while ($cliente = $clientes->fetch_object()): ?>
                        <tr class="align-middle">
                            <!-- Detalles de artículos -->
                            <td><?= $cliente->id ?></td>
                            <td><?= $cliente->apellidos ?></td>
                            <td><?= $cliente->nombre ?></td>
                            <td><?= $cliente->telefono ?></td>
                            <td><?= $cliente->ciudad ?></td>
                            <td><?= $cliente->dni ?></td>
                            <td><?= $cliente->email ?></td>

                            <!-- Columna de acciones -->
                            <td>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <a href="eliminar.php?id=<?= $cliente->id ?>" title="Eliminar" class="btn btn-danger"
                                        onclick="return confirm('Confimar elimación del cliente')"><i
                                            class="bi bi-trash-fill"></i></a>
                                    <a href="editar.php?id=<?= $cliente->id ?>" title="Editar" class="btn btn-primary"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="mostrar.php?id=<?= $cliente->id ?>" title="Mostrar" class="btn btn-warning"><i
                                            class="bi bi-eye-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">Nº Clientes <?= $clientes->num_rows ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>