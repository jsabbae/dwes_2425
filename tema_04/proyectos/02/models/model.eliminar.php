<?php
    /*
        Modelo: model.eliminar.php
        Descripción: eliminar un elemento de la tabla
    */

    // Cargamos las tablas
    $cursos = Class_tabla_alumnos::getCursos();
    $asignaturas = Class_tabla_alumnos::getAsignaturas();
    $alumnos = new Class_tabla_alumnos();
    $alumnos->getAlumnos();
    // Extraemos el id a través del método get
    $id = $_GET['indice'];
    $alumnos->delete($id);