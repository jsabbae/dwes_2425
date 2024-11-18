<?php
// Controlador: editar.php
// Descripción: Mostrar un formulario con los detalles editables del articulo seleccionado

// Cargamos las clases correspondientes
include 'class/class.articulo.php';
include 'class/class.tabla_articulo.php';


// Modelos
include 'models/model.editar.php'; // Cargo los detalles del libro a editar

// vista
include "views/view.editar.php"; // Mostrar la vista con los detalles del libro
?>