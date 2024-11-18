<?php
/*
    clase: class.tabla_alumnos.php
    descripcion: define la clase que va a contener el array de objetos de la clase alumnos.
*/

class Class_tabla_alumnos
{
    private $tabla;


    function __construct(
        $tabla = []
    ) {
        $this->tabla = $tabla;
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
    // Función de todas las asignaturas
    static public function getAsignaturas()
    {
        $asignaturas = [
            '2DAW Desarrollo Entorno Web',
            '2DAW Diseño de Interfaces Web',
            '2DAW Hora LIbre Configuración',
            '2DAW Despliegue de Aplicaciones Web',
            '2DAW Desarrollo Web Entorno Servidor',
            '2DAW Empresa e Iniciativa Emprendedora',
            '1DAW Programación',
            '1DAW Base de Datos',
            '1DAW Lenguage de Marcas',
            '1DAW Entorno Desarrollo',
            '1DAW Formación Orientación Profesional',
            '1DAW Sistema Informático',
            '1SMR Aplicaciones ofimáticas',
            '1SMR Formación y orientación laboral',
            '1SMR Montaje y mantenimiento de equipo',
            '1SMR Redes locales',
            '1SMR Sistemas operativos monopuestos',
            '2SMR Aplicaciones web',
            '2SMR Empresa e iniciativa emprendedora',
            '2SMR Formación en centros de trabajo',
            '2SMR Seguridad informática',
            '2SMR Servicios en red',
            '2SMR Sistemas operativos en red'

        ];
        asort($asignaturas);            // Ordenar array
        return $asignaturas;
    }

    // Función de todas los cursos
    static public function getCursos()
    {
        $cursos = [
            '1DAW',
            '2DAW',
            '1SMR',
            '2SMR',
            '1AD',
            '2AD'
        ];
        asort($cursos);
        return $cursos;
    }

    // Función de todos los alumnos registrados
    public function getAlumnos()
    {
        # Alumno 1
        $alumno1 = new Alumno(
            1,
            'Francisco',
            'Ortega',
            'francisco@gmail.com',
            '12/02/2000',
            2,
            [6, 7, 8]
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $alumno1;

        # Alumno 2
        $alumno2 = new Alumno(
            2,
            'María',
            'Sánchez',
            'maria@gmail.com',
            '24/06/1998',
            1,
            [3, 1, 2]
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $alumno2;

        # Alumno 3
        $alumno3 = new Alumno(
            3,
            'Enrique',
            'López',
            'enrique@gmail.com',
            '12/12/2005',
            3,
            [2, 4, 5]
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $alumno3;

        # Alumno 4
        $alumno4 = new Alumno(
            4,
            'Lucas',
            'Chacón',
            'lucas@gmail.com',
            '23/08/2003',
            2,
            [6, 7, 8]
        );

        # Añado el objeto a la tabla
        $this->tabla[] = $alumno4;
        # Alumno 5
        $alumno5 = new Alumno(
            5,
            'José',
            'Martinez',
            'jose@gmail.com',
            '17/01/2002',
            4,
            [5, 1, 3]
        );
        # Añado el objeto a la tabla
        $this->tabla[] = $alumno5;
    }

    // Declarada estatica debido a que no modifica ningún atributo de la clases
    static public function mostrarAsignaturas($asignaturas, $asignaturasAlumno = [])
    {
        $aux = [];
        foreach ($asignaturasAlumno as $indice) {
            $aux[] = $asignaturas[$indice];
        }
        asort($aux);
        return $aux;
    }

    public function create(object $data)
    {
        $this->tabla[] = $data;
    }

    public function read($indice)
    {
        return $this->tabla[$indice];
    }

    public function delete($indice)
    {
        unset($this->tabla[$indice]);
        array_values($this->tabla);
    }

    public function update($indice, object $data)
    {
        $this->tabla[$indice] = $data;
    }
}
?>