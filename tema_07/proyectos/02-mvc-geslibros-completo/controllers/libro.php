<?php

class libro extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    /*
        Método principal

        Se  carga siempre que la url contenga sólo el primer parámetro

        url: /libro
    */
    public function render()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje de error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        } // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['libros']['main'])) {
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tienes permisos suficientes';
            header('location' . URL . 'auth/login');
            exit();
        }


        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Compruebo si hay mensaje de éxito
        if (isset($_SESSION['mensaje'])) {

            // Creo la propiedad mensaje en la vista
            $this->view->mensaje = $_SESSION['mensaje'];

            // Elimino la variable de sesión mensaje
            unset($_SESSION['mensaje']);
        }

        // Compruebo si hay mensaje de error
        if (isset($_SESSION['mensaje_error'])) {

            // Creo la propiedad mensaje_error en la vista
            $this->view->mensaje_error = $_SESSION['mensaje_error'];

            // Elimino la variable de sesión mensaje_error
            unset($_SESSION['mensaje_error']);
        }

        // Compruebo validación errónea de formulario
        if (isset($_SESSION['error'])) {

            // Creo la propiedad mensaje_error en la vista
            $this->view->mensaje_error = $_SESSION['error'];

            // Elimino la variable de sesión error
            unset($_SESSION['error']);
        }

        // Creo la propiedad title de la vista
        $this->view->title = "Gestión de Geslibros";

        // Creo la propiedad libros para usar en la vista
        $this->view->libros = $this->model->get();

        $this->view->render('libro/main/index');
    }

    /*
        Método nuevo()

        Muestra el formulario que permite añadir nuevo libro

        url asociada: /libro/nuevo
    */
    public function nuevo()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['libros']['nuevo'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'libro');
            exit();
        }

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Crear un objeto vacío de la clase libro
        $this->view->libro = new classLibro();

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad libro en la vista
            $this->view->libro = $_SESSION['libro'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión libro
            unset($_SESSION['libro']);
        }

        // Creo la propiead título
        $this->view->title = "Añadir - Gestión de libros";

        // Creo la propiedad autores en la vista
        $this->view->autores_id = $this->model->get_autores();

        // Creo la propiedad editoriales en la vista
        $this->view->editorial_id = $this->model->get_editoriales();

        // Creo la propiedad generos en la vista
        $this->view->generos_id = $this->model->get_generos();

        // Cargo la vista asociada a este método
        $this->view->render('libro/nuevo/index');
    }

    /*
        Método create()

        Permite añadir nuevo libro al formulario

        url asociada: /libro/create
        POST: detalles del libro
    */
    public function create()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['libros']['nuevo'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'libro');
            exit();
        }

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            // require_once 'controllers/error.php';
            // $controller = new Errores('Petición no válida');
            // exit();
            header('location:' . URL . 'errores');
            exit();
        }




        // Recogemos los detalles del formulario
        // Prevenir ataques XSS
        $titulo = filter_var($_POST['titulo'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor_id = filter_var($_POST['autor_id'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        $editorial_id = filter_var($_POST['editorial_id'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        $generos_id = isset($_POST['generos_id']) ? implode(',', array_map('intval', $_POST['generos_id'])) : '';
        $precio = filter_var($_POST['precio'] ?? '', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $stock = filter_var($_POST['stock'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        $fecha_edicion = filter_var($_POST['fecha_edicion'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $isbn = filter_var($_POST['isbn'] ?? '', FILTER_SANITIZE_NUMBER_INT);

        // Formatear el precio para que siempre tenga una coma decimal
        $precio = number_format($precio, 2, '.', '');

        // Creamos un objeto de la clase libro
        $libro = new classLibro(
            null,
            $titulo,
            $autor_id,
            $editorial_id,
            $generos_id,
            $stock,
            $precio,
            $fecha_edicion,
            $isbn
        );

        // Validación de los datos

        // Creo un array para almacenar los errores
        $error = [];


        // Validación del titulo
        // Reglas: obligatorio
        if (empty($titulo)) {
            $error['titulo'] = 'El titulo es obligatorio';
        }

        // Validación del autor
        // Reglas: obligatorio
        if (empty($autor_id)) {
            $error['autor_id'] = 'El autor es obligatorio';
        } else if (!filter_var($autor_id, FILTER_VALIDATE_INT)) {
            $error['autor_id'] = 'El formato del autor no es correcto';
        } else if (!$this->model->validateForeignKeyAutor($autor_id)) {
            $error['autor_id'] = 'El autor no existe';
        }

        // Validación del editorial
        // Reglas: obligatorio
        if (empty($editorial_id)) {
            $error['editorial_id'] = 'El editorial es obligatorio';
        } else if (!filter_var($editorial_id, FILTER_VALIDATE_INT)) {
            $error['editorial_id'] = 'El formato del editorial no es correcto';
        } else if (!$this->model->validateForeignKeyEditorial($editorial_id)) {
            $error['editorial_id'] = 'El editorial no existe';
        }

        //  Validación de precio
        // Reglas: obligatorio
        if (empty($precio)) {
            $error['precio'] = 'El precio es obligatorio';
        } else if (!filter_var($precio, FILTER_VALIDATE_FLOAT)) {
            $error['precio'] = 'El formato del precio no es correcto';
        }

        // Validación de unidades
        // Reglas: opcional

        // Validación de fecha de edición
        // Reglas: obligatorio
        if (empty($fecha_edicion)) {
            $error['fecha_edicion'] = 'La fecha de edición es obligatoria';
        } else {
            $fecha = DateTime::createFromFormat('Y-m-d', $fecha_edicion);
            if (!$fecha) {
                $error['fecha_edicion'] = 'El formato de la fecha de edición no es correcto';
            }
        }

        // Validación de ISBN
        // Reglas: obligatorio
        if (empty($isbn)) {
            $error['isbn'] = 'El ISBN es obligatorio';
        } else if (!preg_match('/^\d{13}$/', $isbn)) {
            $error['isbn'] = 'El formato del ISBN no es correcto, debe tener 13 dígitos';
        } else if ($this->model->isUniqueIsbn($isbn)) {
            $error['isbn'] = 'El ISBN ya existe';
        }

        // Validacion de generos
        // Reglas: obligatorio
        if (empty($generos_id)) {
            $error['generos_id'] = 'El género es obligatorio';
        } else {
            foreach ($_POST['generos_id'] as $genero) {
                if (!filter_var($genero, FILTER_VALIDATE_INT)) {
                    $error['generos_id'] = 'El formato del género no es correcto';
                } else if (!$this->model->validateForeignKeyGenero($genero)) {
                    $error['generos_id'] = 'El género no existe';
                }
            }
        }

        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sesión libro con los datos del formulario
            $_SESSION['libro'] = $libro;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;


            // redireciona al formulario de nuevo
            header('location:' . URL . 'libro/nuevo');
            exit();
        }

        // Añadimos libro a la tabla
        $this->model->create($libro);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Libro añadido con éxito';

        // redireciona al main de libro
        header('location:' . URL . 'libro');
        exit();
    }

    /*
        Método editar()

        Muestra el formulario que permite editar los detalles de un libro

        url asociada: /libro/editar/id

        @param int $id: id del libro a editar

    */
    function editar($param = [])
    {

        # obtengo el id del libro que voy a editar
        // libro/edit/4
        // -- libro es el titulo del controlador
        // -- edit es el titulo del método
        // -- $param es un array porque puedo pasar varios parámetros a un método

        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['libros']['editar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'libro');
            exit();
        }


        # obtengo el id del libro que voy a editar
        // libro/edit/4
        $this->view->id = htmlspecialchars($param[0]);

        # obtengo el token CSRF
        $this->view->csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $this->view->csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        # obtener objeto de la clase libro con el id asociado
        $this->view->libro = $this->model->read($this->view->id);


        // Compruebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad libro en la vista
            $this->view->libro = $_SESSION['libro'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión libro
            unset($_SESSION['libro']);
        }



        # obtener los autores
        $this->view->autores = $this->model->get_autores();

        # obtener los editoriales
        $this->view->editoriales = $this->model->get_editoriales();

        # obtener los generos
        $this->view->generos = $this->model->get_generos();

        # title
        $this->view->title = "Formulario Editar - Gestión de libros";

        # cargo la vista
        $this->view->render('libro/editar/index');
    }

    /*
        Método update()

        Actualiza los detalles de un libro

        url asociada: /libro/update/id

        POST: detalles del libro

        @param int $id: id del libro a editar
    */
    public function update($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['libros']['editar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'libro');
            exit();
        }

        // obtengo el id del libro que voy a editar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Recogemos los detalles del formulario

        $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor_id = filter_var($_POST['autor_id'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $editorial_id = filter_var($_POST['editorial_id'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $generos_id = $_POST['generos_id'] ?? [];
        $stock = filter_var($_POST['stock'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $precio = filter_var($_POST['precio'] ??= '', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $fecha_edicion = filter_var($_POST['fecha_edicion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $isbn = filter_var($_POST['isbn'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        // Formatear el precio para que siempre tenga una coma decimal
        $precio = number_format($precio, 2, '.', '');

        # Con los detalles formulario creo objeto libro
        $libro_form = new classlibro(

            null,
            $titulo,
            $autor_id,
            $editorial_id,
            $generos_id,
            $stock,
            $precio,
            $fecha_edicion,
            $isbn

        );


        // Validación de los datos

        // Obtengo los detalles del libro de la base de datos
        $libro = $this->model->read($id);

        // Creo un array para almacenar los errores
        $error = [];

        // Control de cambios en los campos
        $cambios = false;

        // Validación del titulo
        // Reglas: obligatorio


        if (strcmp($titulo, $libro->titulo) != 0) {
            $cambios = true;
            if (empty($titulo)) {
                $error['titulo'] = 'El titulo es obligatorio';
            }
        }

        // Validación del autor
        // Reglas: obligatorio

        if ($autor_id != $libro->autor_id) {
            $cambios = true;
            if (empty($autor_id)) {
                $error['autor_id'] = 'El autor es obligatorio';
            } else if (!filter_var($autor_id, FILTER_VALIDATE_INT)) {
                $error['autor_id'] = 'El formato del autor no es correcto';
            } else if (!$this->model->validateForeignKeyAutor($autor_id)) {
                $error['autor_id'] = 'El autor no existe';
            }
        }

        // Validación del editorial
        // Reglas: obligatorio
        if ($editorial_id != $libro->editorial_id) {
            $cambios = true;
            if (empty($editorial_id)) {
                $error['editorial_id'] = 'La editorial es obligatoria';
            } else if (!filter_var($editorial_id, FILTER_VALIDATE_INT)) {
                $error['editorial_id'] = 'El formato del editorial no es correcto';
            } else if (!$this->model->validateForeignKeyEditorial($editorial_id)) {
                $error['editorial_id'] = 'La editorial no existe';
            }
        }


        //  Validación de precio
        // Reglas: obligatorio
        if ($precio != $libro->precio) {
            $cambios = true;
            if (empty($precio)) {
                $error['precio'] = 'El precio es obligatorio';
            } else if (!filter_var($precio, FILTER_VALIDATE_FLOAT)) {
                $error['precio'] = 'El formato del precio no es correcto';
            }
        }


        // Validación de unidades
        // Reglas: opcional

        // Validación de fecha de edición
        // Reglas: obligatorio
        if ($fecha_edicion != $libro->fecha_edicion) {
            $cambios = true;
            if (empty($fecha_edicion)) {
                $error['fecha_edicion'] = 'La fecha de edición es obligatoria';
            } else {
                $fecha = DateTime::createFromFormat('Y-m-d', $fecha_edicion);
                if (!$fecha) {
                    $error['fecha_edicion'] = 'El formato de la fecha de edición no es correcto';
                }
            }
        }

        // Validación de ISBN
        // Reglas: obligatorio

        if ($isbn != $libro->isbn) {
            $cambios = true;
            if (empty($isbn)) {
                $error['isbn'] = 'El ISBN es obligatorio';
            } else if (!preg_match('/^\d{13}$/', $isbn)) {
                $error['isbn'] = 'El formato del ISBN no es correcto, debe tener 13 dígitos';
            } else if ($this->model->isUniqueIsbn($isbn)) {
                $error['isbn'] = 'El ISBN ya existe';
            }
        }

        // Validacion de generos
        // Reglas: obligatorio
        if ($generos_id != $libro->generos_id) {
            $cambios = true;
            if (empty($generos_id)) {
                $error['generos_id'] = 'El género es obligatorio';
            } else {
                foreach ($_POST['generos_id'] as $genero) {
                    if (!filter_var($genero, FILTER_VALIDATE_INT)) {
                        $error['generos_id'] = 'El formato del género no es correcto';
                    } else if (!$this->model->validateForeignKeyGenero($genero)) {
                        $error['generos_id'] = 'El género no existe';
                    }
                }
            }
        }


        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sesión libro con los datos del formulario
            $_SESSION['libro'] = $libro_form;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'libro/editar/' . $id . '/' . $csrf_token);
            exit();
        }

        // Compruebo si ha habido cambios
        if (!$cambios) {
            // Genero mensaje de éxito
            $_SESSION['mensaje'] = 'No se han realizado cambios';

            // redireciona al main de libro
            header('location:' . URL . 'libro');
            exit();
        }


        # Actualizo base  de datos
        // Necesito crear el método update en el modelo
        $this->model->update($libro_form, $id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Libro actualizado con éxito';

        # Cargo el controlador principal de libro
        header('location:' . URL . 'libro');
        exit();

    }

    /*
        Método eliminar()

        Borra un libro de la base de datos

        url asociada: /libro/eliminar/id

        @param
            :int $id: id del libro a eliminar
    */
    public function eliminar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['libros']['eliminar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'libro');
            exit();
        }

        // obtengo el id del libro que voy a eliminar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        if (isset($param[1])) {
            $csrf_token = $param[1];
        } else {
            $csrf_token = '';
        }

        // Validación CSRF
        if (empty($csrf_token) || !hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Validar id del libro
        // validateIdLibro($id) si existe devuelve TRUE
        if (!$this->model->validateIdLibro($id)) {
            // Genero mensaje de error
            $_SESSION['mensaje'] = 'El libro no existe';
            // redireciona al main de libro
            header('location:' . URL . 'libro');
            exit();
        }
        # Id ha sido validado
        # Elimino libro de la base de datos
        $this->model->delete($id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Libro eliminado con éxito';

        # Cargo el controlador principal de libro
        header('location:' . URL . 'libro');
    }

    /*
        Método mostrar()

        Muestra los detalles de un libro

        url asociada: /libro/mostrar/id

        @param
            :int $id: id del libro a mostrar
    */
    public function mostrar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['libros']['mostrar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'libro');
            exit();
        }

        // obtengo el id del libro que voy a eliminar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        if (isset($param[1])) {
            $csrf_token = $param[1];
        } else {
            $csrf_token = '';
        }

        // Validación CSRF
        if (empty($csrf_token) || !hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Validar id del libro
        // validateIdLibro($id) si existe devuelve TRUE
        if (!$this->model->validateIdLibro($id)) {
            // Genero mensaje de error
            $_SESSION['error'] = 'ID no válido';

            // redireciona al main de libro
            header('location:' . URL . 'libro');
            exit();
        }

        # Cargo el título
        $this->view->title = "Mostrar - Gestión de libros";

        # Obtengo los detalles del libro mediante el método read del modelo
        $this->view->libro = $this->model->read($id);

        # obtener los autores
        $this->view->autores = $this->model->get_autores();

        # obtener las editoriales
        $this->view->editoriales = $this->model->get_editoriales();

        # obtener los generos
        $this->view->generos = $this->model->get_generos();

        # Cargo la vista
        $this->view->render('libro/mostrar/index');
    }

    /*
        Método filtrar()

        Busca un libro en la base de datos

        url asociada: /libro/filtrar/expresion

        GET: 
            - expresion de búsqueda

        DEVUELVE:
            - PDOStatement con los libros que coinciden con la expresión de búsqueda
    */
    public function filtrar()
    {

        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['libros']['filtrar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'libro');
            exit();
        }

        # Obtengo la expresión de búsqueda
        $expresion = htmlspecialchars($_GET['expresion']);

        // obtengo el token CSRF
        $csrf_token = htmlspecialchars($_GET['csrf_token']);

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        # Cargo el título
        $this->view->title = "Filtrar por: {$expresion} - Gestión de libros";

        # Obtengo los libros que coinciden con la expresión de búsqueda
        $this->view->libros = $this->model->filter($expresion);

        # Cargo la vista
        $this->view->render('libro/main/index');
    }

    /*
        Método ordenar()

        Ordena los libros de la base de datos

        url asociada: /libro/ordenar/id

        @param
            :int $id: id del campo por el que se ordenarán los libros
    */
    public function ordenar($param = [])
    {

        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['libros']['ordenar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'libro');
            exit();
        }

        // Obtener criterio
        $id = (int) htmlspecialchars($param[0]);

        // obtengo el token CSRF
        if (isset($param[1])) {
            $csrf_token = $param[1];
        } else {
            $csrf_token = '';
        }

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        # Criterios de ordenación
        $criterios = [
            1 => 'ID',
            2 => 'titulo',
            3 => 'autor_id',
            4 => 'editorial_id',
            5 => 'generos_id',
            6 => 'stock',
            7 => 'precio',
            8 => 'fecha_edicion',
            9 => 'isbn'
        ];

        # Cargo el título
        $this->view->title = "Ordenar por {$criterios[$id]} - Gestión de libros";

        # Obtengo los libros ordenados por el campo id
        $this->view->libros = $this->model->order($id);

        # Cargo la vista
        $this->view->render('libro/main/index');
    }
}
