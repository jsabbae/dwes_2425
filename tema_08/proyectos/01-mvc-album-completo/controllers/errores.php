<?php

    class Errores extends Controller {

        function __construct() {

            parent ::__construct();
        }

        public function render() {
            $this->view->titulo = 'Error';
            $this->view->mensaje = 'Recurso no encontrado';
            $this->view->render('errores/index');
            
        }

      

    }

?>