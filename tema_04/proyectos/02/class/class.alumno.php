<?php
/*
    archivo:class.alumno.php
    descripción: define la clase alumno con propiead encapsulamiento
*/

class Alumno
{
        public $id;
        public $nombre;
        public $apellidos;
        public $email;
        public $f_nacimiento;
        public $curso;
        public $asignaturas;


        public function __construct(
                $id = null,
                $nombre = null,
                $apellidos = null,
                $email = null,
                $f_nacimiento = null,
                $curso = null,
                $asignaturas = []
        ) {
                $this->id = $id;
                $this->nombre = $nombre;
                $this->apellidos = $apellidos;
                $this->email = $email;
                $this->f_nacimiento = $f_nacimiento;
                $this->curso = $curso;
                $this->asignaturas = $asignaturas;
        }

        /** 
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         */
        public function setId($id): self
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of nombre
         */
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         */
        public function setNombre($nombre): self
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of apellidos
         */
        public function getApellido()
        {
                return $this->apellidos;
        }

        /**
         * Set the value of apellidos
         */
        public function setApellido($apellidos): self
        {
                $this->apellidos = $apellidos;

                return $this;
        }

        /**
         * Get the value of email
         */
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         */
        public function setEmail($email): self
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of f_nacimiento
         */
        public function getFnacimiento()
        {
                return $this->f_nacimiento;
        }

        /**
         * Set the value of f_nacimiento
         */
        public function setFnacimiento($f_nacimiento): self
        {
                $this->f_nacimiento = $f_nacimiento;

                return $this;
        }

        /**
         * Get the value of cursos
         */
        public function getCurso()
        {
                return $this->curso;
        }

        /**
         * Set the value of curso
         */
        public function setCurso($curso): self
        {
                $this->curso = $curso;

                return $this;
        }

        /**
         * Get the value of asignaturas
         */
        public function getAsignatura()
        {
                return $this->asignaturas;
        }

        /**
         * Set the value of asignaturas
         */
        public function setAsignatura($asignaturas): self
        {
                $this->asignaturas = $asignaturas;

                return $this;
        }



        public function getEdad()
        {
                $fechaNacimiento = DateTime::createFromFormat('d/m/Y', $this->f_nacimiento);
                $fecha_actual = new DateTime();
                $edadAlumno = $fecha_actual->diff($fechaNacimiento)->y;
                return $edadAlumno;
        }


}

?>