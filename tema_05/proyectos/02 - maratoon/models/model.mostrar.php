<?php

/*
    modelo: model.mostrar.php
    descripción: carga los datos del corredor que deseo actualizar

    Método GET:

        - id de la tabla en la que se encuentra el corredor
*/

# Cargamos el id del corredor
$id = $_GET['id'];

# Creo un objeto de la clase tabla de corredores
$obj_tabla_corredores = new Class_tabla_corredores();

#  Cargo los corredores
$obj_tabla_corredores->getCorredores();

# Cargo el array de categorias - lista desplegable dinámica
$categorias = $obj_tabla_corredores->getCategorias();

# Cargo el array de clubs - lista desplegable dinámica
$clubs = $obj_tabla_corredores->getClubs();

# Obtener el objeto de la clase artículo correspondiente a ese índice
$corredor = $obj_tabla_corredores->read($id);

# Forma alternativa por la propiedad de no encapsulamiento
// $corredor = $obj_tabla_corredores->tabla[$id];

