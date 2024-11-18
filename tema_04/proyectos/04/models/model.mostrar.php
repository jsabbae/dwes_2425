<?php
/*
    Modelo: model.mostrar.php
    Descripción: Carga los datos del profesor

    Método GET:
        -   indice de la tabla en la que se encuentra el profesor
*/

#   Cargo el indice del profesor
$indice = $_GET['indice'];

#   Creo un objeto de la clase tabla profesor
$obj_tabla_profesor = new Class_tabla_profesor();

#   Cargo los datos del profesor
$obj_tabla_profesor->getDatos();

#   Cargar el array especialidades - lista desplegable dinámica
$especialidades = $obj_tabla_profesor->getEspecialidad();

#   Cargar el array asignaturas - lista checkbox dinámica
$asignaturas = $obj_tabla_profesor->getAsignaturas();

#   Obtener el objeto de la clase profesor con su correspondiente indice
$profesor = $obj_tabla_profesor->read($indice);
