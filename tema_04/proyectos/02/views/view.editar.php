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
        <legend>Editar Alumno - CRUD Alumnos</legend>

        <!-- Añadimos el menú -->
        <?php include 'partials/partial.menu.php' ?>

       
         <!-- Formulario Editar Alumno -->
         <br>
         <form action="update.php?indice=<?=$indice?>" method="POST">
            <!-- Id -->
            <div class="mb-3">
                <label class="form-label">id</label>
                <input type="number" class="form-control" name="id" value="<?=$alumno->id?>" readonly>
            </div>
            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?=$alumno->nombre?>">
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?=$alumno->apellidos?>">
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?=$alumno->email?>">
            </div>
            <!-- Fecha de Nacimiento -->
            <div class="mb-3">
                <label class="form-label">Fecha de Nacimiento</label>
                <?php $fechaForm = date('Y-m-d', strtotime(str_replace("/","-",$alumno->f_nacimiento)));?>
                <input type="date" class="form-control" name="fecha_nacimiento" value="<?=$fechaForm?>">
            </div>
            <!-- Curso -->
            <div class="mb-3">
                <label class="form-label">Curso</label>
                <select class="form-select" name="curso">

                    <?php foreach($cursos as $key => $curso): ?>
                        <option value="<?=$key?>"
                        <?=($alumno->curso == $key)?'selected':null ?>
                        >
                        <?=$curso?></option>
                    <?php endforeach; ?>
                </select>
            </div>
           
            <!-- Asignaturas -->
            <div class="mb-3">
                <label class="form-label">Asignaturas</label>
                <div class="form-control">
                    <!-- Recorre el array ($asignaturas) de cada elemento($key) -->
                    <?php foreach ($asignaturas as $key => $asignatura): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $key ?>" name="asignaturas[]"
                            <?=(in_array($key,$alumno->asignaturas) ? 'checked': null)?>>
                            <label class="form-check-label">
                                <?= $asignatura ?>
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
     <?php include 'partials/partial.footer.php' ?>


    <!-- js bootstrap 532-->
    <?php include 'layouts/layout.javascript.html' ?>
</body>

</html>