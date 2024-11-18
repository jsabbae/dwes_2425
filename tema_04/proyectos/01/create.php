<?php
/*
    Controlador: create.php
    Descripción: permite cargar los nuevos valores al array principal con los datos de la aplicación        
*/

// Cargamos las clases correspondientes
include 'class/class.articulo.php';
include 'class/class.tabla_articulo.php';

// Cargaremos el modelo
include 'models/model.create.php';


// Cargamos la vista
include 'views/view.index.php';
?>