<?php
    /*
        Modelo: model.nuevo.php
        Descripción: genera los datos necesarios para añadir nuevo alumno
    */

    $cursos=Class_tabla_alumnos::getCursos();
    $asignaturas=Class_tabla_alumnos::getAsignaturas();

    $alumnos = new Class_tabla_alumnos();
    $alumnos->getAlumnos();
?>