<?php

// Cargamos los datos de categorias y marcas
$categorias = ArrayArticulos::getCategorias();
$marcas = ArrayArticulos::getMarcas();

$articulos = new ArrayArticulos();
$articulos->getDatos();
?>