<?php
    /*
        Modelo: model.index.php
        Descripcion: genera un array con datos de los alumnos
    */
    setlocale(LC_MONETARY,"es_ES");

    // Cargamos los arrays
    $asignaturas = Class_tabla_alumnos::getAsignaturas(); // Con los :: se podrá acceder a propiedades y métodos estáticos
    $cursos = Class_tabla_alumnos::getCursos();

    // Creamos un objeto de la clase de Alumnos
    $alumnos = new Class_tabla_alumnos(); // Inicializado como array vacío
    $alumnos->getAlumnos(); // Cargamos los datos