<?php
// Controlador index.php
// Muestra los detalles de los artículos

// Cargamos las clases. A tener en cuenta el orden, ya que es importante
include 'class/class.articulo.php';
include 'class/class.tabla_articulo.php';

// Cargamos el modelo
include 'models/model.index.php';

// Cargamos la vista principal
include 'views/view.index.php';
?>