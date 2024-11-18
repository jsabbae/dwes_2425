<?php

/*
    Modelo: model.editar.php
    Descripción: carga los datos del profesor que voy a actualizar

Método GET:

-   indice de la tabla en la que se encuentra el profesor

    */

#   Cargamos el indice del profesor
$indice = $_GET['indice'];

#   Creo un objeto de la clase tabla profesor
$obj_tabla_profesor = new Class_tabla_profesor();

#   Cargo los datos de los profesores
$obj_tabla_profesor->getDatos();

#   Cargo el array de Especialidades - lista desplegable dinámica
$especialidades = $obj_tabla_profesor->getEspecialidad();

#   Cargo el array de Asignaturas - lista checkbox dinámica
$asignaturas = $obj_tabla_profesor->getAsignaturas();

#   Obtener el objeto de la clase profesor correspondiente a ese indice
$profesor = $obj_tabla_profesor->read($indice);

