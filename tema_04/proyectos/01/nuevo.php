<?php
// Controlador nuevo.php
// Carga el formulario de introducción de nuevo artículo

// Cargamos las clases correspondientes
include 'class/class.articulo.php';
include 'class/class.tabla_articulo.php';

// añadimos el modelo donde tenemos lo datos definidos
include 'models/model.nuevo.php';

// cargamos la vista
include 'views/view.nuevo.php';
?>