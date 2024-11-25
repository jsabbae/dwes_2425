<?php

/*
    clase: class.tabla_alumnos.php
    descripcion: define la clase que va a contener el array de objetos de la clase alumnos.
*/

class Class_tabla_alumnos extends Class_conexion
{

    public $tabla;


    public function getAlumnos()
    {

        $sql = "
       select
            alumnos.id,
            alumnos.nombre,
            alumnos.apellidos,
            alumnos.email,
            alumnos.telefono,
            alumnos.nacionalidad,
            alumnos.dni,
            timestampdiff (YEAR, alumnos.fechaNac, now()) as edad,
            alumnos.id_curso
        FROM
            alumnos
            ";

        //  ejecuto comando sql
        $result = $this->mysqli->query($sql);

        // if (!$result) {
        //     die("Error en la consulta SQL: " . $this->mysqli->error);
        // }

        //  obtengo un objeto de la clase mysqli_result
        //  devuelvo dicho objeto
        return $result;
    }

    /*
        método: mostrar_nombre_categorias()
        descripción: devuelve un array con el nombre de las categorías
        parámetros:
            - indice_categorias
    */

    // public function mostrar_nombre_etiquetas($indice_etiquetas = [])
    // {
    //     # creo array de nombre de categorías vacío
    //     $nombre_etiquetas = [];

    //     # cargo el array de etiquetas del alumno
    //     $etiquetas_alumnos = $this->getEtiquetas();

    //     foreach ($indice_etiquetas as $indice) {
    //         $nombre_etiquetas[] = $etiquetas_alumnos[$indice];
    //     }

    //     # Ordeno
    //     asort($nombre_etiquetas);
    //     return $nombre_etiquetas;
    // }

    /*
        método: create()
        descripcion: permite añadir un objeto de la clase artículo a la tabla
        parámetros:

            - $alumno - objeto de la clase alumno

    */
    // public function create(Class_alumno $alumno)
    // {
    //     $this->tabla[] = $alumno;
    // }

    /*
        método: read()
        descripcion: permite obtener el objeto de la clase alumno a partir de un índice 
        de la tabla

        parámetros:

            - $indice - índice de la tabla
    */
    // public function read($indice)
    // {
    //     return $this->tabla[$indice];
    // }

    /*
        método: update()
        descripcion: permite actualizar los detalles de un alumno en la tabla

        parámetros:

            - $alumno - objeto de la clase alumno, con los detalles actualizados de dicho artículo
            - $indice - índice de la tabla
    */
    // public function update(Class_alumno $alumno, $indice)
    // {
    //     $this->tabla[$indice] = $alumno;
    // }


    /*
        método: delete()
        descripcion: permite eliminar un alumno de la tabla

        parámetros:

            - $indice - índice de la tabla en la que se encuentra el alumno
    */
    // public function delete($indice)
    // {
    //     unset($this->tabla[$indice]);
    // }
}
