<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'layouts/layout.head.html' ?>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">
        <!-- Cabecera -->
        <?php include 'partials/partial.header.php' ?>
        <legend>Gestión de Alumnos - Home </legend>

        <!-- Añadimos el menú -->
        <?php include 'partials/partial.menu.php' ?>

        <!-- Pie de documento -->
        <?php include 'partials/partial.footer.php' ?>


        <!-- Añadimos una tabla con los artículos -->
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Edad</th>
                    <th>Curso</th>
                    <th>Asignaturas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Mostraremos el contenido de cada artículo -->
            <tbody>
                <?php foreach ($alumnos->getTabla() as $indice => $alumno): ?>
                    <tr>
                        <th>
                            <?= $alumno->id ?>
                        </th>
                        <td>
                            <?= $alumno->nombre ?>
                        </td>
                        <td>
                            <?= $alumno->apellidos ?>
                        </td>
                        <td>
                            <?= $alumno->email ?>
                        </td>
                        <td>
                            <?= $alumno->getEdad() ?>
                        </td>
                        <td>
                            <?= $cursos[$alumno->curso] ?>
                        </td>
                        <td>
                            <?= implode(', ', Class_tabla_alumnos::mostrarAsignaturas($asignaturas, $alumno->asignaturas)) ?>
                        </td>

                        <!-- Columna de acciones -->

                        <td>
                            <a href="eliminar.php?indice=<?= $indice ?>" title="Eliminar">
                                <i class="bi bi-trash-fill"></i>
                            </a>

                            <a href="editar.php?indice=<?= $indice ?>" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="mostrar.php?indice=<?= $indice ?>" title="Mostrar">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- En el pie de la tabla, mostraremos el número de artículos mostrados -->
            <tfoot>
                <tr>
                    <td colspan="5"><b>Nº Registros
                            <?= count($alumnos->getTabla()) ?>
                        </b></td>
                </tr>
            </tfoot>
            <br>
        </table>
        <br>
        <br>
        <br>

    </div>


    <!-- js bootstrap 532-->
    <?php include 'layouts/layout.javascript.html' ?>
</body>

</html>