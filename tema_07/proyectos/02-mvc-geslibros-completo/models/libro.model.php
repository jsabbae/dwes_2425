<?php

/*
    libroModel.php

    Modelo del controlador libro

    Métodos:

        - get()
*/

class libroModel extends Model
{

    /*
        método: get()

        Extre los detalles de la tabla libros
    */
    public function get()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                libros.id,
                libros.titulo,
                autores.nombre as autor,
                editoriales.nombre as editorial,
                GROUP_CONCAT(generos.tema ORDER BY generos.tema SEPARATOR ', ') as genero,
                libros.stock,
                libros.precio,
                libros.fecha_edicion,
                libros.isbn
            FROM 
                libros 
                 INNER JOIN
                autores
            ON libros.autor_id = autores.id
            INNER JOIN
                editoriales
            ON libros.editorial_id = editoriales.id
            INNER JOIN
                generos
            ON FIND_IN_SET(generos.id, libros.generos_id)
            Group by libros.id
            ORDER BY libros.id";

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
       método: get_autores()

       Extre los detalles de los autores para generar lista desplegable 
       dinámica
   */
    public function get_autores()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                        id,
                        nombre as autor
                    FROM 
                        autores
                    ORDER BY
                        2
            ";


            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt->fetchAll();
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
   método: get_editoriales()

   Extre los detalles de las editoriales para generar lista desplegable 
   dinámica
*/

    public function get_editoriales()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                        id,
                        nombre as editorial
                    FROM 
                        editoriales
                    ORDER BY
                        2
            ";


            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt->fetchAll();
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
     método: get_generos()

     Extre los detalles de las generos para generar lista desplegable 
     dinámica
  */

    public function get_generos()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                    id,
                    tema as genero
                FROM 
                    generos
                ORDER BY
                    2
        ";


            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt->fetchAll();
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }


    /*
        método: create

        descripción: añade nuevo libro
        parámetros: objeto de classlibro
    */

    public function create(classlibro $libro)
    {

        try {
            $sql = "INSERT INTO libros (
                    titulo,
                    autor_id,
                    editorial_id,
                    generos_id,
                    stock,
                    precio,
                    fecha_edicion,
                    isbn
                )
                VALUES (
                    :titulo,
                    :autor_id,
                    :editorial_id,
                    :generos_id,
                    :stock,
                    :precio,
                    :fecha_edicion,
                    :isbn
                )
            ";
            # Conectar con la base de datos
            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 30);
            $stmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_STR, 50);
            $stmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_STR, 50);
            $stmt->bindParam(':generos_id', $libro->generos_id, PDO::PARAM_STR, 45);
            $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_STR, 30);
            $stmt->bindParam(':precio', $libro->precio, PDO::PARAM_STR, 9);
            $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR);
            $stmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_INT);


            // añado libro
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

        descripción: obtiene los detalles de un libro
        parámetros: id del libro
        devuelve: objeto con los detalles del libro
        
    */

    public function read(int $id)
    {

        try {
            $sql = "
            SELECT 
                libros.id,
                libros.titulo,
                autores.nombre as autor,
                autores.id as autor_id,
                editoriales.nombre as editorial,
                editoriales.id as editorial_id,
                GROUP_CONCAT(generos.tema ORDER BY generos.tema SEPARATOR ', ') as genero,
                libros.generos_id as generos_id,
                libros.stock,
                libros.precio,
                libros.fecha_edicion,
                libros.isbn
            FROM 
                libros 
            INNER JOIN
                autores
            ON libros.autor_id = autores.id
            INNER JOIN
                editoriales
            ON libros.editorial_id = editoriales.id
            INNER JOIN
                generos
            ON FIND_IN_SET(generos.id, libros.generos_id)
            GROUP BY libros.id
            HAVING 
                libros.id = :id
            LIMIT 1
            ";

            # Conectar con la base de datos
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

        descripción: actualiza los detalles de un libro

        @param:
            - objeto de classlibro
            - id del libro
    */

    public function update(classlibro $libro, $id)
    {

        try {

            $sql = "
            
            UPDATE libros
            SET
                    titulo = :titulo,
                    autor_id = :autor_id,
                    editorial_id = :editorial_id,
                    generos_id = :generos_id,
                    stock = :stock,
                    precio = :precio,
                    fecha_edicion = :fecha_edicion,
                    isbn = :isbn
            WHERE
                    id = :id
            LIMIT 1
            ";

            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 30);
            $stmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_STR, 50);
            $stmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_STR, 30);
            $stmt->bindParam(':generos_id', implode(",", $libro->generos_id), PDO::PARAM_STR, 45);
            $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_STR, 30);
            $stmt->bindParam(':precio', $libro->precio, PDO::PARAM_STR, 9);
            $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR);
            $stmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_INT);

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

        descripción: elimina un libro

        @param: id del libro
    */

    public function delete(int $id)
    {

        try {

            $sql = "
                DELETE FROM libros
                WHERE id = :id
                LIMIT 1
            ";

            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

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
        método: validateIdAlumno

        descripción: valida el id de un alumno. Que exista en la base de datos

        @param: 
            - id del alumno

    */


public function validateIdLibro(int $id)
    {
        try {
            $sql = "SELECT 
                        id
                    FROM 
                        libros
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


    /*
        método: filter

        descripción: filtra los libros por una expresión

        @param: expresión a buscar
    */
    public function filter($expresion)
    {
        try {
            $sql = "

           SELECT 
                libros.id,
                libros.titulo,
                autores.nombre as autor,
                editoriales.nombre as editorial,
                GROUP_CONCAT(generos.tema ORDER BY generos.tema SEPARATOR ', ') as genero,
                libros.stock,
                libros.precio,
                libros.fecha_edicion,
                libros.isbn
            FROM 
                libros 
            INNER JOIN
                autores
            ON libros.autor_id = autores.id
            INNER JOIN
                editoriales
            ON libros.editorial_id = editoriales.id
            INNER JOIN
                generos
            ON FIND_IN_SET(generos.id, libros.generos_id)
            GROUP BY libros.id
            HAVING
                CONCAT_WS(  ', ', 
                libros.id,
                libros.titulo,
                autores.nombre,
                editoriales.nombre,
                genero,
                libros.stock,
                libros.precio,
                libros.fecha_edicion,
                libros.isbn) 
                like :expresion
            ORDER BY 
                libros.id
            
            ";

            # Conectar con la base de datos
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

        descripción: ordena los libros por un campo

        @param: campo por el que ordenar
    */
    public function order(int $criterio)
    {

        try {

            # comando sql
            $sql = "
            SELECT 
                libros.id,
                libros.titulo,
                autores.nombre as autor,
                editoriales.nombre as editorial,
                generos.tema as genero,
                libros.stock,
                libros.precio,
                libros.fecha_edicion,
                libros.isbn
            FROM 
                libros 
            INNER JOIN
                autores
            ON libros.autor_id = autores.id
            INNER JOIN
                editoriales
            ON libros.editorial_id = editoriales.id
            INNER JOIN
                generos
            ON libros.generos_id = generos.id
            ORDER BY 
                :criterio
            ";

            # conectamos con la base de datos

            // $this->db es un objeto de la clase database
            // ejecuto el método connect de esa clase

            $conexion = $this->db->connect();

            # ejecutamos mediante prepare
            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_INT);

            # establecemos  tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            #  ejecutamos 
            $stmt->execute();

            # devuelvo objeto stmtatement
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
        método: validateForeignKeyAutor($autor_id)

        descripción: valida el autor_id seleccionado. Que exista en la tabla autores

        @param: 
            - $autor_id

    */
    public function validateForeignKeyAutor(int $autor_id)
    {
        try {
            $sql = "SELECT 
                        id
                    FROM 
                        autores
                    WHERE
                        id = :autor_id
                    LIMIT 1
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':autor_id', $autor_id, PDO::PARAM_INT);
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
    /*
        método: validateForeignKeyEditorial($editorial_id)

        descripción: valida el editorial_id seleccionado. Que exista en la tabla editoriales

        @param: 
            - $editorial_id

    */
    public function validateForeignKeyEditorial(int $editorial_id)
    {
        try {
            $sql = "SELECT 
                        id
                    FROM 
                        editoriales
                    WHERE
                        id = :editorial_id
                    LIMIT 1
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':editorial_id', $editorial_id, PDO::PARAM_INT);
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

    /*
    método: isUniqueISBN($isbn)

    descripción: valida que el isbn no esté duplicado


    */

    public function isUniqueISBN($isbn)
    {
        try {
            $sql = "SELECT 
                        id
                    FROM 
                        libros
                    WHERE
                        isbn = :isbn
                    LIMIT 1
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':isbn', $isbn, PDO::PARAM_INT);
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

    /*

        método: validateForeignKeyGenero($generos_id)

        descripción: valida el generos_id seleccionado. Que exista en la tabla generos

        @param: 
            - $generos_id

    */
    public function validateForeignKeyGenero(int $generos_id)
    {
        try {
            $sql = "SELECT 
                        id
                    FROM 
                        generos
                    WHERE
                        id = :generos_id
                    LIMIT 1
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':generos_id', $generos_id, PDO::PARAM_INT);
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


}
