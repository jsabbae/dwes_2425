<?php

/*
    albumModel.php

    Modelo del controlador album

    Métodos:

        - get()
*/

class albumModel extends Model
{

    /*
        método: get()

        Extre los detalles de la tabla albumes
    */
    public function get()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                id,
                titulo,
                descripcion,
                autor,
                fecha,
                lugar,
                categoria,
                etiquetas,
                num_fotos,
                num_visitas,
                carpeta
            FROM 
                albumes 
            ORDER BY id";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt;
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
    método: getCategorias

    descripción: devuelve un array con las categorías de los albumes
    */

    public function getCategorias()
    {
        return [
            'Naturaleza',
            'Retratos',
            'Eventos',
            'Viajes',
            'Deportes'
        ];
    }


    /*
        método: create

        descripción: añade nuevo album
        parámetros: objeto de classalbum
    */

    public function create(classalbum $album)
    {

        try {
            $sql = "INSERT INTO albumes (
                    titulo,
                    descripcion,
                    autor,
                    fecha,
                    lugar,
                    categoria,
                    etiquetas,
                    num_fotos,
                    num_visitas,
                    carpeta
                )
                VALUES (
                    :titulo,
                    :descripcion,
                    :autor,
                    :fecha,
                    :lugar,
                    :categoria,
                    :etiquetas,
                    0,
                    0,
                    :carpeta
                )
            ";
            // Conectar con la base de datos
            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':titulo', $album->titulo, PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $album->descripcion, PDO::PARAM_STR);
            $stmt->bindParam(':autor', $album->autor, PDO::PARAM_STR);
            $stmt->bindParam(':fecha', $album->fecha, PDO::PARAM_STR);
            $stmt->bindParam(':lugar', $album->lugar, PDO::PARAM_STR);
            $stmt->bindParam(':categoria', $album->categoria, PDO::PARAM_STR);
            $stmt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR);
            // $stmt->bindParam(':num_fotos', $album->num_fotos, PDO::PARAM_INT);
            // $stmt->bindParam(':num_visitas', $album->num_visitas, PDO::PARAM_INT);
            $stmt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR);
            // $stmt->bindParam(':created_at', $album->created_at, PDO::PARAM_STR);
            // $stmt->bindParam(':update_at', $album->update_at, PDO::PARAM_STR);

//  Crear una carpeta dentro de la carpeta imagenes con el nombre de la propiedad $album->carpeta

            mkdir('imagenes/' . $album->carpeta);

            // añado album
            $stmt->execute();

        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: read

        descripción: obtiene los detalles de un album
        parámetros: id del album
        devuelve: objeto con los detalles del album
        
    */

    public function read(int $id)
    {

        try {
            $sql = "
            SELECT 
                id,
                titulo,
                descripcion,
                autor,
                fecha,
                lugar,
                categoria,
                etiquetas,
                num_fotos,
                num_visitas,
                carpeta
            FROM 
                albumes 
                WHERE id = :id
            LIMIT 1
            ";

            // Conectar con la base de datos
            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            // // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();

        }
    }

    /*
        método: update

        descripción: actualiza los detalles de un album

        @param:
            - objeto de classalbum
            - id del album
    */

    public function update(classalbum $album, $id)
    {

        try {

            $sql = "
            
            UPDATE albumes
            SET
                    titulo = :titulo,
                    descripcion = :descripcion,
                    autor = :autor,
                    fecha = :fecha,
                    lugar = :lugar,
                    categoria = :categoria,
                    etiquetas = :etiquetas,
                    num_fotos = :num_fotos,
                    num_visitas = :num_visitas,
                    carpeta = :carpeta
            WHERE
                    id = :id
            LIMIT 1
            ";

            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->bindParam(':titulo', $album->titulo, PDO::PARAM_STR, 30);
            $stmt->bindParam(':descripcion', $album->descripcion, PDO::PARAM_STR, 50);
            $stmt->bindParam(':autor', $album->autor, PDO::PARAM_STR, 30);
            $stmt->bindParam(':fecha', $album->fecha, PDO::PARAM_STR, 45);
            $stmt->bindParam(':lugar', $album->lugar, PDO::PARAM_STR, 30);
            $stmt->bindParam(':categoria', $album->categoria, PDO::PARAM_STR, 45);
            $stmt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR, 200);
            $stmt->bindParam(':num_fotos', $album->num_fotos, PDO::PARAM_INT);
            $stmt->bindParam(':num_visitas', $album->num_visitas, PDO::PARAM_INT);
            $stmt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR, 30);

            $stmt->execute();
        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: delete

        descripción: elimina un album

        @param: id del album
    */

    public function delete(int $id, $album)
    {
        try {

            $sql = "DELETE FROM albumes WHERE id = :id limit 1";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Usamos la función glob, para iterar y eliminar  todos los archivos
            $archivos = glob('imagenes/' . $album . '/*.*');

            // Iteramos  sobre cada elemento del array y lo borramos
            foreach ($archivos as $archivo) {
                if (is_file($archivo)) {
                    unlink($archivo);
                }
            }

            // Finalmente, eliminamos la carpeta asociada
            rmdir('imagenes/' . $album);

        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();

        }
    }

    /*
        método: validateIdAlumno

        descripción: valida el id de un alumno. Que exista en la base de datos

        @param: 
            - id del alumno

    */




    /*
        método: filter

        descripción: filtra los albumes por una expresión

        @param: expresión a buscar
    */
    public function filter($expresion)
    {
        try {
            $sql = "

           SELECT 
                    id,
                    titulo, 
                    descripcion, 
                    autor,
                    fecha,
                    lugar,
                    categoria,
                    etiquetas,
                    num_fotos,
                    num_visitas,
                    carpeta
            FROM 
                albumes 
            WHERE
                CONCAT_WS(  ', ', 
                id,
                titulo,
                descripcion,
                autor,
                fecha,
                lugar,
                categoria,
                etiquetas,
                num_fotos,
                num_visitas,
                carpeta
                ) 
                like :expresion
            ORDER BY 
                id
            
            ";

            // Conectar con la base de datos
            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindValue(':expresion', '%' . $expresion . '%', PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {

            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: order

        descripción: ordena los albumes por un campo

        @param: campo por el que ordenar
    */
    public function order(int $criterio)
    {

        try {
            $sql = "
           SELECT 
                    id,
                    titulo, 
                    descripcion, 
                    autor,
                    fecha,
                    lugar,
                    categoria,
                    etiquetas,
                    num_fotos,
                    num_visitas,
                    carpeta
            FROM 
                albumes 
            ORDER BY 
                :criterio
            ";



            // $this->db es un objeto de la clase database
            // ejecuto el método connect de esa clase

            // Conectamos con la base de datos

            $conexion = $this->db->connect();

            // Ejecutamos mediante prepare
            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_INT);

            // Establecemos  tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            //  Ejecutamos 
            $stmt->execute();

            // Devuelvo objeto stmtatement
            return $stmt;

        } catch (PDOException $e) {

            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();

        }
    }


    public function validarIdAlbum(int $id)
    {
        try {
            $sql = "SELECT 
                        id
                    FROM 
                        albumes
                    WHERE
                        id = :id
                    LIMIT 1
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                return TRUE;
            }

            return FALSE;
        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }


    public function obtenerCarpetaPorId($albumId)
    {
        try {
            $sql = "SELECT 
                                carpeta
                        FROM 
                                albumes
                        WHERE
                                id = :id
                ";

            // Conectar con la base de datos
            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $albumId, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            return $stmt->fetch();

        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    public function uploadFicheros($archivos, $carpeta)
    {
        // Generar un array de errores de fichero
        $fileUploadErrors = array(
            0 => 'No hay errores, el archivo se cargó con éxito',
            1 => 'El archivo subido excede la directiva upload_max_filesize en php.ini',
            2 => 'El archivo subido excede la directiva MAX_FILE_SIZE',
            3 => 'El archivo subido se cargó solo parcialmente',
            4 => 'No se cargó ningún archivo',
            6 => 'Falta una carpeta temporal',
            7 => 'Error al escribir el archivo en el disco.',
            8 => 'Una extensión de PHP detuvo la carga del archivo.',
        );

        // Almacenará los errores encontrados en los archivos
        $errores = [];

        // Validar cada archivo subido
        foreach ($archivos['name'] as $index => $nombreArchivo) {
            // Comprobar si hay errores
            if ($archivos['error'][$index] !== UPLOAD_ERR_OK) {
                $errores[] = $fileUploadErrors[$archivos['error'][$index]];
            } else {
                // Validar el tamaño máximo (5 MB)
                $maxSize = 5 * 1024 * 1024;
                if ($archivos['size'][$index] > $maxSize) {
                    $errores[] = "El tamaño del archivo '$nombreArchivo' excede el límite de 5MB.";
                }

                // Validar el tipo de archivo
                $extensiones = ['jpg', 'gif', 'png'];
                $fileInfo = new SplFileInfo($nombreArchivo);
                $extension = $fileInfo->getExtension();

                if (!in_array(strtolower($extension), $extensiones)) {
                    $errores[] = "El archivo '$nombreArchivo' no es una imagen JPG, GIF o PNG.";
                }
            }
        }

        // Si hay errores en algún archivo, cancelar la subida de todos los archivos
        if (!empty($errores)) {
            $_SESSION['error'] = implode(PHP_EOL, $errores);
            return; // Terminar el proceso de subida de archivo
        }

        // Si no hay errores, se procede a mover los archivos a la carpeta del álbum
        foreach ($archivos['name'] as $index => $nombreArchivo) {
            move_uploaded_file($archivos['tmp_name'][$index], 'imagenes/' . $carpeta . '/' . $nombreArchivo);
        }

        // Añadimos un mensaje  de confirmación
        $_SESSION['mensaje'] = "Se han subido correctamente las imagenes";
    }

    public function nuevaVisita($id)
    {
        try {
            // Creamos la consulta sql
            $sql = "UPDATE 
                    albumes
             SET 
                    num_visitas=num_visitas+1
              WHERE
                    id = :id 
               LIMIT 1";

            // Creamos la conexión
            $conexion = $this->db->connect();

            // Preparamos la consulta
            $stmt = $conexion->prepare($sql);

            // Vinculamos la variable
            $stmt->bindParam(':id', $id);

            // Ejecutamos la consulta
            $stmt->execute();

        } catch (PDOException $e) {

            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();

        }
    }

    public function contFotos($id, $numeroFotos)
    {
        try {
            // Creamos la consulta sql
            $sql = "UPDATE 
                albumes 
            SET 
                num_fotos=:numFotos 
            WHERE
                 id = :id
            LIMIT 1";

            // Creamos la conexión
            $conexion = $this->db->connect();

            // Preparamos la consulta
            $stmt = $conexion->prepare($sql);

            // Vinculamos la variable
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':numFotos', $numeroFotos);

            // Ejecutamos la consulta
            $stmt->execute();

        } catch (PDOException $e) {

            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;

            exit();

        }
    }

}
