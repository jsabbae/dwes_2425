<?php
    /*
        Modelo: model.editar.php
        Descripción: editar los detalles de un alumno
    */
    // Cargamos los valores correspondientes
    $cursos=Class_tabla_alumnos::getCursos();
    $asignaturas=Class_tabla_alumnos::getAsignaturas();

    # Creamos un objeto de la clase de la tabla Alumnos
    $alumnos = new Class_tabla_alumnos();

    // Cargamos los datos
    $alumnos->getAlumnos();

    // Extraemos el id
    $indice = $_GET['indice'];

    // cargamos los detallas del alumno a partir del indice (dentro de un objeto de la clase alumno)
    $alumno = $alumnos->read($indice);