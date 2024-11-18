<?php

/*
    Modelo: model.eliminar.php
    Descripción: eliminar un profesor de la tabla

    Método GET: 
            -   indice: de la tabla donde se encuentra el profesor que voy a eliminar
*/

#   Cargamos el índice del profesor
$indice = $_GET['indice'];

#   Creo un objeto de la clase tabla_profesor
$obj_tabla_profesor = new Class_tabla_profesor();

#   Cargo los datos del profesor
$obj_tabla_profesor->getDatos();

#   Cargo el array especialidades - lista desplegable dinámica
$especialidades = $obj_tabla_profesor->getEspecialidad();

#   Obtener el objeto de la clase profesor correspondiente a ese indice
$obj_tabla_profesor->delete($indice);

#   Obtengo la tabla de profesores actualizada a la vista
$array_profesores = $obj_tabla_profesor->getTabla();

