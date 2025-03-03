<?php

class album extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    /*
        Método principal

        Se  carga siempre que la url contenga sólo el primer parámetro

        url: /album
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
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['main'])) {
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
        $this->view->title = "Gestión de Gesalbum";

        // Creo la propiedad albumes para usar en la vista
        $this->view->albumes = $this->model->get();

        $this->view->render('album/main/index');
    }

    /*
        Método nuevo()

        Muestra el formulario que permite añadir nuevo album

        url asociada: /album/nuevo
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
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['nuevo'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Crear un objeto vacío de la clase album
        $this->view->albumes = new classAlbum();

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad album en la vista
            $this->view->albumes = $_SESSION['album'];


            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión album
            unset($_SESSION['album']);
        }

        // Creo la propiead título
        $this->view->title = "Añadir - Gestión de Gesalbum";

        // Obtener categorías
        $this->view->categorias = $this->model->getCategorias();

        // Cargo la vista asociada a este método
        $this->view->render('album/nuevo/index');
    }

    /*
        Método create()

        Permite añadir nuevo album al formulario

        url asociada: /album/create
        POST: detalles del album
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
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['nuevo'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
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
        $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $lugar = filter_var($_POST['lugar'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $categoria = filter_var($_POST['categoria'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);


        // Creamos un objeto de la clase album
        $album = new classAlbum(
            null,
            $titulo,
            $descripcion,
            $autor,
            $fecha,
            $lugar,
            $categoria,
            $etiquetas,
            $carpeta
        );

        // Validación de los datos

        // Creo un array para almacenar los errores
        $error = [];


        // Validación del titulo
        // Reglas: obligatorio y no tiene más de 100 caracteres
        if (empty($titulo)) {
            $error['titulo'] = 'El titulo es obligatorio';
        } else if (strlen($titulo) > 100) {
            $error['titulo'] = 'El titulo no puede tener más de 100 caracteres';
        }


        // Validación de la descripción
        // Reglas: obligatorio
        if (empty($descripcion)) {
            $error['descripcion'] = 'La descripción es obligatoria';
        }
        // Validación de la autor
        // Reglas: obligatorio
        if (empty($autor)) {
            $error['autor'] = 'El/La autor/a es obligatoria';
        }

        // Validación de la fecha
        // Reglas: obligatorio
        if (empty($fecha)) {
            $error['fecha'] = 'La fecha es obligatoria';
        }

        // Validación del lugar
        // Reglas: obligatorio
        if (empty($lugar)) {
            $error['lugar'] = 'El lugar es obligatorio';
        }

        // Validación de la categoria
        // Reglas: obligatorio
        if (empty($categoria)) {
            $error['categoria'] = 'La categoria es obligatoria';
        }

        // Validación de las etiquetas
        // Reglas: opcional


        // Validación de la carpeta
        // Reglas: obligatorio y no tiene espacio
        if (empty($carpeta)) {
            $error['carpeta'] = 'La carpeta es obligatoria';
        } else if (strpos($carpeta, ' ') !== false) {
            $error['carpeta'] = 'La carpeta no puede contener espacios';
        }

        // Si $carpeta ya existe dentro de la carpeta imagenes debes agregar un error indicando que la carpeta ya existe

        if (is_dir('imagenes/' . $carpeta)) {
            $error['carpeta'] = 'La carpeta ya existe';
        }

        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sesión album con los datos del formulario
            $_SESSION['album'] = $album;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;


            // redireciona al formulario de nuevo
            header('location:' . URL . 'album/nuevo');
            exit();
        }

        // Añadimos album a la tabla
        $this->model->create($album);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'album añadido con éxito';

        // redireciona al main de album
        header('location:' . URL . 'album');
        exit();
    }

    /*
        Método editar()

        Muestra el formulario que permite editar los detalles de un album

        url asociada: /album/editar/id

        @param int $id: id del album a editar

    */
    function editar($param = [])
    {

        # obtengo el id del album que voy a editar
        // album/edit/4
        // -- album es el titulo del controlador
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
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['editar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }


        # obtengo el id del album que voy a editar
        // album/edit/4
        $this->view->id = htmlspecialchars($param[0]);

        # obtengo el token CSRF
        $this->view->csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $this->view->csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        # obtener objeto de la clase album con el id asociado
        $this->view->album = $this->model->read($this->view->id);


        // Compruebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad album en la vista
            $this->view->album = $_SESSION['album'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión album
            unset($_SESSION['album']);
        }

        // Obtener categorías
        $this->view->categorias = $this->model->getCategorias();

        # title
        $this->view->title = "Formulario Editar - Gestión de Gesalbum";

        # cargo la vista
        $this->view->render('album/editar/index');
    }

    /*
        Método update()

        Actualiza los detalles de un album

        url asociada: /album/update/id

        POST: detalles del album

        @param int $id: id del album a editar
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
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['editar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // obtengo el id del album que voy a editar
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
        $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $lugar = filter_var($_POST['lugar'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $categoria = filter_var($_POST['categoria'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);



        # Con los detalles formulario creo objeto album
        $album_form = new classAlbum(

            null,
            $titulo,
            $descripcion,
            $autor,
            $fecha,
            $lugar,
            $categoria,
            $etiquetas,
            $carpeta
        );


        // Validación de los datos

        // Obtengo los detalles del album de la base de datos
        $album = $this->model->read($id);

        // Creo un array para almacenar los errores
        $error = [];

        // Control de cambios en los campos
        $cambios = false;

        // Validación del titulo
        // Reglas: obligatorio y no tiene más 100 caracteres


        if (strcmp($titulo, $album->titulo) != 0) {
            $cambios = true;
            if (empty($titulo)) {
                $error['titulo'] = 'El titulo es obligatorio';
            } else if (strlen($titulo) > 100) {
                $error['titulo'] = 'El titulo no puede tener más de 100 caracteres';
            }
        }

        // Validación de la descripción
        // Reglas: obligatorio


        if (strcmp($descripcion, $album->descripcion) != 0) {
            $cambios = true;
            if (empty($descripcion)) {
                $error['descripcion'] = 'La descripción es obligatorio';
            }
        }

        // Validación del autor
        // Reglas: obligatorio
        if ($autor != $album->autor) {
            $cambios = true;
            if (empty($autor)) {
                $error['autor'] = 'El/La autor/a es obligatorio';
            }
        }

        // Validación de la fecha
        // Reglas: obligatorio
        if ($fecha != $album->fecha) {
            $cambios = true;
            if (empty($fecha)) {
                $error['fecha'] = 'La fecha es obligatoria';
            }
        }

        // Validación del lugar
        // Reglas: obligatorio
        if ($lugar != $album->lugar) {
            $cambios = true;
            if (empty($lugar)) {
                $error['lugar'] = 'El lugar es obligatorio';
            }
        }

        // Validación de la categoria
        // Reglas: obligatorio
        // Validación de la categoria
        if (strcmp($categoria, $album->categoria) != 0) {
            $cambios = true;
            if (empty($categoria)) {
                $error['categoria'] = 'La categoria es obligatoria';
            }
        }

        // Validación de las etiquetas
        // Reglas: opcional
        if ($etiquetas != $album->etiquetas) {
            $cambios = true;
        }

        // Validación de la carpeta
        // Reglas: obligatorio y no tiene espacio
        if ($carpeta != $album->carpeta) {
            $cambios = true;
            if (empty($carpeta)) {
                $error['carpeta'] = 'La carpeta es obligatoria';
            } else if (strpos($carpeta, ' ') !== false) {
                $error['carpeta'] = 'La carpeta no puede contener espacios';
            }
        }


        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sesión album con los datos del formulario
            $_SESSION['album'] = $album_form;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'album/editar/' . $id . '/' . $csrf_token);
            exit();
        }

        // Compruebo si ha habido cambios
        if (!$cambios) {
            // Genero mensaje de éxito
            $_SESSION['mensaje'] = 'No se han realizado cambios';

            // redireciona al main de album
            header('location:' . URL . 'album');
            exit();
        }


        # Actualizo base  de datos
        // Necesito crear el método update en el modelo
        $this->model->update($album_form, $id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'album actualizado con éxito';

        # Cargo el controlador principal de album
        header('location:' . URL . 'album');
        exit();

    }

    /*
        Método eliminar()

        Borra un album de la base de datos

        url asociada: /album/eliminar/id

        @param
            :int $id: id del album a eliminar
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
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['eliminar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // obtengo el id del album que voy a eliminar
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

        // Validar id del album
        // validarIdalbum($id) si existe devuelve TRUE
        if (!$this->model->validarIdalbum($id)) {
            // Genero mensaje de error
            $_SESSION['mensaje'] = 'El album no existe';
            // redireciona al main de album
            header('location:' . URL . 'album');
            exit();
        }

        // Añadimos el valor del objeto album según id en una variable
        $albumCarpeta = $this->model->read($id);

        // Elimino album de la base de datos y la carpeta
        $this->model->delete($id, $albumCarpeta->carpeta);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'album eliminado con éxito';

        // redireciona al main de album
        header('location:' . URL . 'album');
    }

    /*
        Método mostrar()

        Muestra los detalles de un album

        url asociada: /album/mostrar/id

        @param
            :int $id: id del album a mostrar
    */
    public function mostrar($param = [])
    {
        // Iniciar o continuar sesión
        session_start();

        // Comprobar si el usuario está autenticado
        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['mostrar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }
        $id = htmlspecialchars($param[0]);

        // Validar id del album
        if (!$this->model->validarIdalbum($id)) {
            // Genero mensaje de error
            $_SESSION['error'] = 'ID no válido';
            // redireciona al main de album
            header('location:' . URL . 'album');
            exit();
        }

        // Obtener información del álbum
        $album = $this->model->read($id);

        // Verificar si el álbum existe
        if (!$album) {
            $_SESSION['error'] = 'El álbum no existe';
            header('location:' . URL . 'album');
            exit();
        }

        // Obtener categorías
        $this->view->categorias = $this->model->getCategorias();

        // Actualizamos las visitas al lugar
        $this->model->nuevaVisita($id);

        // Obtener la lista de imágenes del álbum
        $ruta = 'imagenes/' . $album->carpeta . '/';
        if (is_dir($ruta)) {
            $imagenes = array_diff(scandir($ruta), array('..', '.')); // Obtener lista de imágenes excluyendo . y ..
        } else {
            $imagenes = [];
        }

        // Actualizamos en la base de datos el número de fotos
        $numeroFotos = count($imagenes);
        $this->model->contFotos($id, $numeroFotos);

        // Pasar los datos a la vista
        $this->view->title = "Detalles del álbum";
        $this->view->nombreAlbum = $album->carpeta; // Nombre del álbum
        $this->view->album = $album;
        $this->view->imagenesAlbum = $imagenes; // Pasar la lista de imágenes a la vista

        // Renderizar la vista
        $this->view->render("album/mostrar/index");

    }

    /*
        Método filtrar()

        Busca un album en la base de datos

        url asociada: /album/filtrar/expresion

        GET: 
            - expresion de búsqueda

        DEVUELVE:
            - PDOStatement con los albums que coinciden con la expresión de búsqueda
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
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['filtrar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
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
        $this->view->title = "Filtrar por: {$expresion} - Gestión de Gesalbum";

        # Obtengo los albums que coinciden con la expresión de búsqueda
        $this->view->albumes = $this->model->filter($expresion);

        # Cargo la vista
        $this->view->render('album/main/index');
    }

    /*
        Método ordenar()

        Ordena los albums de la base de datos

        url asociada: /album/ordenar/id

        @param
            :int $id: id del campo por el que se ordenarán los albums
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
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['ordenar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
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
            3 => 'descripcion',
            4 => 'autor',
            5 => 'fecha',
            6 => 'lugar',
            7 => 'categoria',
            8 => 'etiquetas',
            9 => 'num_fotos',
            10 => 'num_visitas',
            11 => 'carpeta'
        ];

        # Cargo el título
        $this->view->title = "Ordenar por {$criterios[$id]} - Gestión de Gesalbum";

        # Obtengo los albums ordenados por el campo id
        $this->view->albumes = $this->model->order($id);

        # Cargo la vista
        $this->view->render('album/main/index');
    }

    /*
        Método agregarImagenes()

        Muestra el formulario que permite añadir imágenes a un album

        url asociada: /album/agregarImagenes/id

        @param
            :int $id: id del album al que se añadirán las imágenes
    */

    public function agregarImagenes($param = [])
    {

        // Inicio o continuo sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['agregarImagenes'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // Si hay errores
        if (!empty($_SESSION['errores'])) {

            // Creo la propiedad errores en la vista
            $this->view->errores = $_SESSION['errores'];
            
            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error al subir la imagen';

            // Elimino la variable de sesión errores
            unset($_SESSION['errores']);
        }

        // Obtengo el id del album
        $id = $param[0];

        // Añadimos el valor del objeto album según id en una variable
        $albumCarpeta = $this->model->read($id);


        // Cargo el título
        $this->view->title = "Añadir imágenes - Gestión de Gesalbum";

        # Cargo el nombre del album
        $this->view->nombreAlbum = $albumCarpeta->carpeta;

        // Cargo el id del album
        $this->view->id = $id;

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Cargo la vista
        $this->view->render('album/agregarImagenes/index');

    }

    /*
        Método upload()

        Sube las imágenes al servidor

        url asociada: /album/upload/id

        @param
            :int $id: id del album al que se añadirán las imágenes
    */

    public function upload($param = [])
    {
        // Iniciar o continuar sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['agregarImagenes'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // Obtener el id del álbum
        $id = htmlspecialchars($param[0]);

        // Obtener el token CSRF
        $csrf_token = $_POST['csrf_token'] ?? '';

        // Validación CSRF
        if (empty($csrf_token) || !hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Obtener el nombre del álbum
        $albumCarpeta = $this->model->read($id);
        $nombreAlbum = $albumCarpeta->carpeta;

        // Obtener el número de archivos
        $numFiles = count($_FILES['ficheros']['name']);

        // Crear un array para almacenar los errores
        $errores = [];

        if ($numFiles > 0) {
            for ($i = 0; $i < $numFiles; $i++) {
                // Compruebo si se ha subido un archivo
                if ($_FILES['ficheros']['size'][$i] == 0) {
                    $errores['fichero'] = 'No se han subido archivos';
                }

                // Compruebo si el archivo ya existe
                if (file_exists('imagenes/' . $nombreAlbum . '/' . $_FILES['ficheros']['name'][$i])) {
                    $errores['fichero'] = 'El archivo ya existe';
                }
            }
        }

        // Procesar la subida de imágenes
        for ($i = 0; $i < $numFiles; $i++) {
            $nombreArchivo = $_FILES['ficheros']['name'][$i];
            $tmpArchivo = $_FILES['ficheros']['tmp_name'][$i];
            $rutaDestino = 'imagenes/' . $nombreAlbum . '/' . $nombreArchivo;

            // Validar tipo de archivo
            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
            if (!in_array($extension, ['jpg', 'png', 'gif'])) {
                $errores['fichero'] = "El archivo $nombreArchivo no es una imagen válida.";
                continue;
            }

            // Validar tamaño de archivo
            if ($_FILES['ficheros']['size'][$i] > 5242880) {
                $errores['fichero'] = "El archivo $nombreArchivo es demasiado grande. El tamaño máximo permitido es de 5MB.";
                continue;
            }

            if (!move_uploaded_file($tmpArchivo, $rutaDestino)) {
                $errores['fichero'] = "Error al mover el archivo $nombreArchivo.";
            }
        }

        // Si hay errores, redirigir de nuevo al formulario
        if (!empty($errores)) {
            $_SESSION['errores'] = $errores;

            header('location:' . URL . 'album/agregarImagenes/' . $id);
            exit();
        }

        // Redirigir al álbum después de la subida exitosa
        $_SESSION['mensaje'] = "Imagen subida con éxito.";
        header('location:' . URL . 'album/mostrar/' . $id);
        exit();
    }
}
