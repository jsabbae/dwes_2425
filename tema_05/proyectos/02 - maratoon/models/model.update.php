<?php

/*
    Modelo: model.update.php
    Descripción: actualiza los datos del corredor

     Métod POST:
        
        - Los detalles del corredor
    
    Método GET:

        - id del corredor
*/

# Símbolo monetario local
setlocale(LC_MONETARY, "es_ES");

# Cargo el id del corredor
$id = $_GET['id'];

# Cargo los detalles del corredor
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$ciudad = $_POST['ciudad'];
$sexo = $_POST['sexo'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$email = $_POST['email'];
$dni = $_POST['dni'];
$id_categoria = $_POST['id_categoria'];
$id_club = $_POST['id_club'];

# Validación

# Creamos objeto de la clase Class_corredor
$corredor = new Class_corredor(
    $id,
    $nombre,
    $apellidos,
    $ciudad,
    $sexo,
    $email,
    $fechaNacimiento,
    $dni,
    $id_categoria,
    $id_club
);

# Actulizo los detalles del corredor en la  tabla
$corredores = new Class_tabla_corredores();

# Llamo al método update de Class_tabla_corredores
$corredores->update($corredor, $id);









