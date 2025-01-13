<?php

    /*
        controlador: filtrar.php
        descripción: muestra los corredores que cumplen una expresión de búsqueda
    */

    # Archivos de configuración
    include 'config/configDB.php';

    # Clases
    include 'class/class.corredor.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_corredores.php';

    # Librerias

    # Model
    include 'models/model.filtrar.php';

    # Vista
    include 'views/view.index.php';