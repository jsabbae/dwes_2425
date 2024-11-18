<?php
    /*
        Modelo: model.update.php
        Descripción: actualiza los detalle de un alumno

        Método POST 
            - nombre
            - apellidos
            - email
            - fecha de nacimiento
            - curso
            - asignaturas
        
        Método GET
            - indice del alumno
    */
    // Cargamos los valores correspondientes
    $cursos = Class_tabla_alumnos::getCursos();
    $asignaturas = Class_tabla_alumnos::getAsignaturas();

    # Creamos un objeto de la clase la clase Class_tabla_alumnos
    $alumnos = new Class_tabla_alumnos();

    // Cargamos los datos
    $alumnos->getAlumnos();

    // Obtenemos el indice (método GET)
    $indice = $_GET['indice'];

   // Recogemos los datos del formulario (método POST)
   $id = $_POST['id'];
   $nombre = $_POST['nombre'];
   $apellidos = $_POST['apellidos'];
   $email = $_POST['email'];
   $fechaNac = $_POST['fecha_nacimiento'];
   $fechaNac = date('d/m/Y', strtotime($fechaNac));
   $curso_alumno = $_POST['curso'];
   $asignaturas_alumno = $_POST['asignaturas'];


// Objeto de alumno
    $alumno=new Alumno(
        $id,
        $nombre,
        $apellidos,
        $email,
        $fechaNac,
        $curso_alumno,
        $asignaturas_alumno
    );
    $alumnos->update($indice,$alumno);
?>