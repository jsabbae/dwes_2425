<?php
/*
    Modelo: modelCreate.php
    descripción: añade el nuevo alumno a la tabla
    
    Métod POST:
        - id
        - nombre
        - apellidos
        - email
        - edad
        - curso
        - asignaturas
*/

// Carga cursos y asignaturas
$cursos = Class_tabla_alumnos::getCursos();
$asignaturas = Class_tabla_alumnos::getAsignaturas();

// Cargamos el array de objetos con alumnos
$alumnos = new Class_tabla_alumnos();
$alumnos->getAlumnos();

// Se recoge los datos
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$fechaNac = $_POST['fecha_nacimiento'];
$fechaNac = date('d/m/Y', strtotime($fechaNac));
$curso_alumno = $_POST['curso'];
$asignaturas_alumno = $_POST['asignaturas'];
//  Se crea un objeto
$alumno = new Alumno($id, $nombre, $apellidos, $email, $fechaNac, $curso_alumno, $asignaturas_alumno);

$alumnos->create($alumno);