<?php
/*
    apellidos: model.create.php
    descripción: añade el nuevo corredor a la tabla
    
    Métod POST (corredor):
        - id
        
*/

# Cargo los detalles del  formulario

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
    null,
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

# Añadimos corredor a la tabla
$corredores = new Class_tabla_corredores();

$corredores->create($corredor);

# Redirecciono al controlador index
header("location: index.php");