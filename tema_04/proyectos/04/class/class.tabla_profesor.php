<?php
class Class_tabla_profesor
{
    public $tabla;

    public function __construct()
    {
        $this->tabla = [];
    }


    /**
     * Get the value of tabla
     */
    public function getTabla()
    {
        return $this->tabla;
    }

    /**
     * Set the value of tabla
     *
     * @return  self
     */
    public function setTabla($tabla)
    {
        $this->tabla = $tabla;

        return $this;
    }
    public function getEspecialidad()
    {
        $especialidades = [
            "Literatura Española",
            "Ciencias Sociales",
            "Matemáticas",
            "Ciencias de la Salud",
            "Ingeniería",
            "Tecnología",
            "Humanidades",
            "Artes",
            "Informática",
            "Religión",
            "Inglés"
        ];
        asort($especialidades);
        return $especialidades;
    }

    public function getAsignaturas()
    {

        $asignaturas =
            [
                "Sistemas informáticos",
                "Bases de datos",
                "Programación",
                "Lenguajes de marcas y sistemas de gestión de información",
                "Entornos de desarrollo",
                "Desarrollo web en entorno cliente (JavaScript, HTML, CSS)",
                "Desarrollo web en entorno servidor (PHP, Node.js, u otros)",
                "Despliegue de aplicaciones web",
                "Diseño de interfaces web",
                "Empresa e iniciativa emprendedora",
                "Formación y orientación laboral (FOL)",
                "Proyecto de desarrollo de aplicaciones web (normalmente al final del ciclo)",
                "Inglés técnico",
                "etc"
            ];
        asort($asignaturas);
        return $asignaturas;
    }
    /*
        método: getDatos()
        descripción: devuelve un array de objetos
    */
    public function getDatos()
    {
        #   Profesor 1
        $profesor = new Class_profesor(
            1,
            "Luis Miguel",
            "Zambroza",
            "4440524757",
            "1984-11-15",
            "Jedula",
            2,
            [5, 1, 3]
        );

        # Añado  el objeto a la tabla
        $this->tabla[] = $profesor;

        # Profesor 2
        $profesor = new Class_profesor(
            2,
            "Frank",
            "Ortiz",
            "4056528751",
            "1990-02-04",
            'Chipiona',
            5,
            [6, 2, 5]
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $profesor;

        #   Profesor 3
        $profesor = new Class_profesor(
            3,
            "José",
            "Pérez",
            "541058289",
            "1982-01-17",
            "Ubrique",
            4,
            [4, 7, 3]
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $profesor;

        #   Profesor 4
        $profesor = new Class_profesor(
            4,
            "Miguel",
            "Bueno",
            "251488977",
            "1973-07-19",
            "Villamartín",
            6,
            [5, 4, 8]
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $profesor;

        #   Profesor 5
        $profesor = new Class_profesor(
            5,
            "Eustaquio",
            "Baena",
            "651188628",
            "1984-07-19",
            "Trebujena",
            8,
            [1, 3, 5]
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $profesor;
    }

    /*
        método: mostrar_nombre_asignaturas()
        descripción: devuelve un array con el nombre de las asignaturas
        parámetros:
                -   indice_asignaturas
    */

    public function mostrar_nombre_asignaturas($indice_asignaturas = [])
    {
        #   Creo un array de nombre de asignaturas vacio
        $nombre_asignaturas = [];

        #   Cargo el array de asignaturas dele profesor 
        $asignaturas_profesores = $this->getAsignaturas();

        foreach ($indice_asignaturas as $indice) {
            $nombre_asignaturas[] = $asignaturas_profesores[$indice];
        }

        #   Ordeno
        asort($nombre_asignaturas);
        return $nombre_asignaturas;


    }

    /*
        método: create()
        descripción: permite añadir el objeto de la clase profesor a la tabla

        parámetros:

            -$profesor - objeto de la clase

    */
    public function create(Class_profesor $profesor)
    {
        $this->tabla[] = $profesor;
    }

    /*
        método: read()
        descripción: permite obtener el objeto de la clase profesor a partir de un índice de la tabla

        parámetros:

        -índice - índice de la tabla

    */
    public function read($indice): Class_profesor
    {
        return $this->tabla[$indice];
    }

    /*
        método: update()
        descripción: permite actualizar los detalles del profesor a la tabla

        parámetros:
        -   $profesor - objeto de la clase profesor, con los detalles actualizados de dicho profesor.
        -   $indice -  índice de la tabla

    */
    public function update(Class_profesor $profesor, $indice)
    {
        $this->tabla[$indice] = $profesor;
    }

    /*
        método: delete()
        descripción: permite eliminar un profesor de la tabla

        parámetros:
        -   $indice - índice de la tabla en la que se encuentra el profesor
    */
    public function delete($indice)
    {
        unset($this->tabla[$indice]);
    }

}