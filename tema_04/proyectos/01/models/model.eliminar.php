<?php
/*
    Modelo: model.eliminar.php
    Descripción: elimina un elemento de la tabla
*/

// Cargamos las tablas
$categorias = ArrayArticulos::getCategorias();
$marcas = ArrayArticulos::getMarcas();
$articulos = new ArrayArticulos();
$articulos->getDatos();

// Extraemos el id a través del método get
$id = $_GET['indice'];


// Invocamos a la función eliminar
$articulos->delete($id);

// Notificacion
$notificacion = "Artículo eliminado";
?>