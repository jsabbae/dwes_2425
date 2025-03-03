<?php

class libro extends Controller
{

    function __construct()
    {

        parent::__construct();
    }


    /*
        Método checkLogin()

        Permite checkear si el usuario está logueado, si no está logueado 
        redirecciona a la página de login

    */
    public function checkLogin()
    {

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
    }

    /*
        Método checkPermissions()

        Permite checkear si el usuario tiene permisos suficientes para acceder a una página

        @param
            - array $roles: roles permitidos
    */
    public function checkPermissions($priviliges)
    {

        // Comprobar si el usuario tiene permisos
        if (!in_array($_SESSION['role_id'], $priviliges)) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'libro');
            exit();
        }
    }

    /*
        Método checkTokenCsrf()

        Permite checkear si el token CSRF es válido

        @param
            - string $csrf_token: token CSRF
    */
    public function checkTokenCsrf($csrf_token)
    {

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }
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

    /*
          Método exportar()

          Permite exportar los libros a un archivo CSV

          url asociada: /libro/exportar/csv

          @param
              :string $format: formato de exportación
      */
    public function exportar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libros']['exportar']);

        // Obtener formato
        // en nuestro caso no haría falta puesto que solo tenemos disponible csv
        $formato = $param[0];

        // Obtener alumnos
        $libros = $this->model->get_csv();

        // Crear archivo CSV
        $file = 'libros.csv';

        // Limpiar buffer antes de enviar headers
        if (ob_get_length())
            ob_clean();

        // Enviamos las cabeceras al navegador para empezar a descargar el archivo
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $file);
        header('Pragma: no-cache');
        header('Expires: 0');

        // Abrimos el archivo csv, con permisos de escritura
        $fichero = fopen('php://output', 'w');

        // Escribir BOM UTF-8 para compatibilidad con Excel
        fprintf($fichero, chr(0xEF) . chr(0xBB) . chr(0xBF));

        // Escribimos los datos del fichero csv
        foreach ($libros as $libro) {
            fputcsv($fichero, $libro, ';');
        }
        // Cerramos el fichero
        fclose($fichero);

        // Cerramos el buffer de salida y enviamos al cliente el archivo csv
        ob_end_flush();
        exit;
    }

    /*
        Método importar()

        Permite importar los libros desde un archivo CSV

        url asociada: /libro/importar/csv

        @param
            :string $format: formato de importación
    */
    public function importar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libros']['importar']);

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['mensaje_error'])) {

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = $_SESSION['mensaje_error'];

            // Elimino la variable de sesión error
            unset($_SESSION['mensaje_error']);
        }

        // Generar propiedad title
        $this->view->title = "Importar Libros desde fichero CSV";

        // Cargar la vista
        $this->view->render('libro/importar/index');
    }


    public function validar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($_POST['csrf_token']);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libros']['importar']);

        // Comprobar si se ha subido un archivo
        if (!isset($_FILES['file'])) {
            $_SESSION['mensaje_error'] = 'No se ha subido ningún archivo';
            header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
            exit();
        }

        // Comprobar si el archivo se ha subido correctamente
        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['mensaje_error'] = 'Error al subir el archivo';
            header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
            exit();
        }

        // Verificar la extensión del archivo
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if ($extension !== 'csv') {
            $_SESSION['mensaje_error'] = "El archivo debe tener extensión .csv";
            header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
            exit();
        }

        // Comprobar si el archivo es válido
        $file = $_FILES['file']['tmp_name'];

        // Abrir el archivo
        $fichero = fopen($file, 'r');

        // Leer el archivo
        $libros = [];

        while (($linea = fgetcsv($fichero, 0, ';')) !== FALSE) {
            // Validaciones

            // Validar título
            if (empty($linea[0])) {
                $_SESSION['mensaje_error'] = 'El título es obligatorio';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            }

            // Validar autor
            if (empty($linea[1])) {
                $_SESSION['mensaje_error'] = 'El autor es obligatorio';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            } else {
                $autor_nombre = $linea[1]; // Usar el nombre del autor
                $autor_id = $this->model->validateForeignKeyAutorImportar($autor_nombre);
                if ($autor_id === false) {
                    $_SESSION['mensaje_error'] = 'El autor no existe';
                    header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                    exit();
                }
                $linea[1] = $autor_id;
            }

            // Validar editorial
            if (empty($linea[2])) {
                $_SESSION['mensaje_error'] = 'La editorial es obligatoria';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            } else {
                $editorial_nombre = $linea[2]; // Usar el nombre de la editorial
                $editorial_id = $this->model->validateForeignKeyEditorialImportar($editorial_nombre);
                if ($editorial_id === false) {
                    $_SESSION['mensaje_error'] = 'La editorial no existe';
                    header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                    exit();
                }
                $linea[2] = $editorial_id;
            }

            // Validar géneros
            if (empty($linea[3])) {
                $_SESSION['mensaje_error'] = 'El género es obligatorio';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            } else {
                $generos = explode(',', $linea[3]);
                $generos_id = [];

                foreach ($generos as $genero) {
                    $genero_id = $this->model->validateForeignKeyGeneroImportar($genero);
                    if ($genero_id === false) {
                        $_SESSION['mensaje_error'] = 'El género ' . htmlspecialchars($genero) . ' no existe';
                        header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                        exit();
                    }
                    $generos_id[] = $genero_id;
                }
                $linea[3] = implode(',', $generos_id);
            }

            // Validar stock
            if (!isset($linea[4]) || !filter_var($linea[4], FILTER_VALIDATE_INT) && $linea[4] !== '0') {
                $_SESSION['mensaje_error'] = 'El formato del stock no es correcto';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            }

            // Validar precio
            if (empty($linea[5])) {
                $_SESSION['mensaje_error'] = 'El precio es obligatorio';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            } else if (!filter_var($linea[5], FILTER_VALIDATE_FLOAT)) {
                $_SESSION['mensaje_error'] = 'El formato del precio no es correcto';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            }

            // Validar fecha de edición
            if (empty($linea[6])) {
                $_SESSION['mensaje_error'] = 'La fecha de edición es obligatoria';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            } else {
                $fecha = DateTime::createFromFormat('d/m/Y', $linea[6]);
                if (!$fecha) {
                    $_SESSION['mensaje_error'] = 'El formato de la fecha de edición no es correcto';
                    header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                    exit();
                } else {
                    // Convertir la fecha al formato Y-m-d antes de guardarla
                    $linea[6] = $fecha->format('Y-m-d');
                }
            }

            // Validar ISBN
            if (empty($linea[7])) {
                $_SESSION['mensaje_error'] = 'El ISBN es obligatorio';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            } else {
                // Convertir el ISBN a una cadena de texto
                $isbn = strval($linea[7]);
                // Eliminar cualquier carácter no numérico
                $isbn = preg_replace('/\D/', '', $isbn);
                // Verificar si el ISBN ya existe
                if ($this->model->isUniqueIsbn($isbn)) {
                    $_SESSION['mensaje_error'] = 'El ISBN ya existe';
                    header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                    exit();
                }
                // Reemplazar el valor del ISBN en la línea con el valor formateado
                $linea[7] = $isbn;
            }
            $libros[] = $linea;
        }

        // Cerrar el archivo
        fclose($fichero);

        // Importar los libros
        $count = $this->model->import($libros);

        // Guardar el archivo subido en la ubicación deseada ('csv/registros.csv')
        $destination = 'csv/registros.csv';
        if (!move_uploaded_file($file, $destination)) {
            $_SESSION['mensaje_error'] = 'Error al guardar el archivo';
            header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
            exit();
        }

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = $count . ' Libros importados con éxito';

        // redireciona al main de libro
        header('location:' . URL . 'libro');
        exit();
    }

}
