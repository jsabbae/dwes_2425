<?php
    /* 
        Modelo: model.mostrar.php
        Descripción: muestra los detalles de un alumno
    */

     // Cargamos los valores
     $cursos = Class_tabla_alumnos::getCursos();
     $asignaturas = Class_tabla_alumnos::getAsignaturas();
 
     # Creamos un objeto de la clase de alumnos
     $alumnos = new Class_tabla_alumnos();
 
     // Cargamos los datos
     $alumnos->getAlumnos();
 
     // Extraemos el id
     $indice = $_GET['indice'];
     $alumno = $alumnos->read($indice);
?>