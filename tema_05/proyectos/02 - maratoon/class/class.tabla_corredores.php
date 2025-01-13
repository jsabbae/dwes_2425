<?php

/*
    clase: class.tabla_corredores.php
    descripcion: define la clase que va a contener el array de objetos de la clase corredores.
*/

class Class_tabla_corredores extends Class_conexion
{


    /*
        método: getCorredores()
        descripcion: devuelve un objeto de la clase mysqli_result con los 
        detalles de los corredores
    */

    public function getCorredores()
    {
        try {

            // sentencia sql
            $sql = "
            select 
                corredores.id,
                corredores.nombre, 
                corredores.apellidos,
                corredores.ciudad,
                corredores.sexo,
                timestampdiff(YEAR, corredores.fechaNacimiento, now()) as edad,
                corredores.email,
                corredores.dni,
                categorias.nombreCorto as categoria,
                clubs.nombreCorto as club
            FROM 
                corredores 
            INNER JOIN
                categorias
            ON corredores.id_categoria = categorias.id
            INNER JOIN
                clubs
            ON  corredores.id_club = clubs.id
            ORDER BY corredores.id
        ";

            // ejecuto comando sql
            $result = $this->db->query($sql);

            // obtengo un objeto de la clase mysqli_result
            return $result;
        } catch (mysqli_sql_exception $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero result
            $result->close();

            // cierro conexión
            $this->db->close();

            // cancelo ejecución programa
            exit();
        }
    }


    /*
        método: create()
        descripcion: permite añadir un objeto de la clase corredor a la tabla
        
        parámetros:

            - $corredor - objeto de la clase corredor

    */
    public function create(Class_corredor $corredor)
    {
        try {

            // Crear la sentencia preparada
            $sql = "
        INSERT INTO 
            corredores( 
                    nombre,
                    apellidos,
                    ciudad,
                    sexo,
                    fechaNacimiento,
                    email,
                    dni,
                    id_categoria, 
                    id_club
                   )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)                              
        ";

            // ejecuto la sentenecia preprada
            $stmt = $this->db->prepare($sql);

            // vinculación de parámetros
            $stmt->bind_param(
                'sssssssii',
                $nombre,
                $apellidos,
                $ciudad,
                $sexo,
                $email,
                $fechaNacimiento,
                $dni,
                $id_categoria,
                $id_club
            );

            // asignar valores
            $nombre = $corredor->nombre;
            $apellidos = $corredor->apellidos;
            $ciudad = $corredor->ciudad;
            $sexo = $corredor->sexo;
            $email = $corredor->email;
            $fechaNacimiento = $corredor->fechaNacimiento;
            $dni = $corredor->dni;
            $id_categoria = $corredor->id_categoria;
            $id_club = $corredor->id_club;

            // ejecutamos
            $stmt->execute();
        } catch (mysqli_sql_exception $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero sentencia preprada
            $stmt->close();

            // cierro conexión
            $this->db->close();

            // cancelo ejecución programa
            exit();
        }
    }

    /*
        método: read()
        descripcion: permite obtener el objeto de la clase corredor a partir del id del corredor 

        parámetros:

            - $id - id del corredor
    */
    public function read($id)
    {
        try {

            // Crear la sentencia sql
            $sql = "SELECT 
            corredores.id,
            corredores.nombre,
            corredores.apellidos,
            corredores.ciudad,
            corredores.sexo,
            TIMESTAMPDIFF(YEAR, corredores.fechaNacimiento, NOW()) AS edad,
            corredores.email,
            corredores.dni,
            categorias.nombreCorto AS categoria,
            clubs.nombreCorto AS club
        FROM 
            corredores 
        INNER JOIN
            categorias ON corredores.id_categoria = categorias.id
        INNER JOIN
            clubs ON corredores.id_club = clubs.id
        WHERE 
            corredores.id = ? LIMIT 1";

            // Creo la sentencia preprada objeto clase mysqli_stmt
            $stmt = $this->db->prepare($sql);

            // vinculación de parámetros
            $stmt->bind_param(
                'i',
                $id
            );

            // ejecutamos
            $stmt->execute();

            // Devolvemos objeto de la clase  mysqli_result
            $result = $stmt->get_result();

            // Devolvemos un objeto de la clase corredor
            return $result->fetch_object();
        } catch (mysqli_sql_exception $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero sentencia preprada
            $stmt->close();

            // libero result
            $result->close();

            // cierro conexión
            $this->db->close();

            // cancelo ejecución programa
            exit();
        }
    }

    /*
        método: update()
        descripcion: permite actualizar los detalles de un corredor en la tabla

        parámetros:

            - $corredor - objeto de Class_corredor
            - $id - id del corredor
    */
    public function update(Class_corredor $corredor, $id)
    {
        try {

            // Crear la sentencia preparada
            $sql = "
            UPDATE corredores SET 
                    nombre = ?,
                    apellidos = ?,
                    ciudad = ?,
                    sexo = ?,
                    fechaNacimiento = ?,
                    email = ?,
                    dni = ?,
                    id_categoria = ?, 
                    id_club = ?
            WHERE 
                    id = ?
            LIMIT 1                            
            ";

            // ejecuto la sentenecia preprada
            $stmt = $this->db->prepare($sql);

            // vinculación de parámetros
            $stmt->bind_param(
                'sssssssiii',
                $nombre,
                $apellidos,
                $ciudad,
                $sexo,
                $fechaNacimiento,
                $email,
                $dni,
                $id_categoria,
                $id_club,
                $id
            );

            // asignar valores
            $nombre = $corredor->nombre;
            $apellidos = $corredor->apellidos;
            $ciudad = $corredor->ciudad;
            $sexo = $corredor->sexo;
            $fechaNacimiento = $corredor->fechaNacimiento;
            $email = $corredor->email;
            $dni = $corredor->dni;
            $id_categoria = $corredor->id_categoria;
            $id_club = $corredor->id_club;

            // ejecutamos
            $stmt->execute();
        } catch (mysqli_sql_exception $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero result
            $stmt->close();

            // cierro conexión
            $this->db->close();

            // cancelo ejecución programa
            exit();
        }
    }


    /*
        getCategorias()

        Método que me devuelve todos las categorias en un array assoc de categorias
    */

    public function getCategorias()
    {
        $sql = "
            SELECT 
                    id, 
                    nombreCorto as categoria
            FROM 
                    categorias
            ORDER BY
                    nombreCorto ASC
        ";

        $result = $this->db->query($sql);

        // devuelvo todos los valores de la  tabla categorias
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /*
        getClubs()

        Método que me devuelve todos los clubes en un array assoc de clubs
    */

    public function getClubs()
    {
        $sql = "
            SELECT
                    id,
                    nombreCorto as club
            FROM
                    clubs
            ORDER BY
                    nombreCorto ASC
        ";

        $result = $this->db->query($sql);

        //  devuelvo todos los valore de la tabla clubs
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /*
        método: order()
        descripcion: devuelve un objeto de la clase mysqli_result con los 
        detalles de los corredores  ordenados por un criterio.

        Parámetros:

            - criterio: posición de la columna en la tabla corredores
                        por la que quiero ordenar
    */

    public function order(int $criterio)
    {
        try {
            // Map the criterio to the actual column name
            $orderByColumn = '';

            switch ($criterio) {
                case 1:
                    $orderByColumn = 'corredores.id';
                    break;
                case 2:
                    $orderByColumn = 'corredores.nombre';
                    break;
                case 3:
                    $orderByColumn = 'corredores.apellidos';
                    break;
                case 4:
                    $orderByColumn = 'corredores.ciudad';
                    break;
                case 7:
                    $orderByColumn = 'corredores.email';
                    break;
                case 8:
                    $orderByColumn = 'edad';
                    break;
                case 10:
                    $orderByColumn = 'categorias.nombreCorto';
                    break;
                case 11:
                    $orderByColumn = 'clubs.nombreCorto';
                    break;
            }

            // Construct SQL query
            $sql = "
                SELECT 
                    corredores.id,
                    corredores.nombre, 
                    corredores.apellidos,
                    corredores.ciudad,
                    corredores.sexo,
                    TIMESTAMPDIFF(YEAR, corredores.fechaNacimiento, NOW()) AS edad,
                    corredores.email,
                    corredores.dni,
                    categorias.nombreCorto AS categoria,
                    clubs.nombreCorto AS club
                FROM 
                    corredores 
                INNER JOIN
                    categorias
                ON corredores.id_categoria = categorias.id
                INNER JOIN
                    clubs
                ON corredores.id_club = clubs.id
                ORDER BY $orderByColumn
            ";

            // Prepare the SQL statement
            $stmt = $this->db->prepare($sql);

            // Execute the query
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            // Return the result
            return $result;
        } catch (mysqli_sql_exception $e) {
            // Handle database errors
            include 'views/partials/errorDB.php';

            // Free up resources
            $stmt->close();
            $result->close();
            $this->db->close();

            // Stop execution of the program
            exit();
        }
    }

    /*
        método: filter()
        descripcion: filtra los 
        detalles de los corredores  ordenados por un criterio.
    */

    public function filter($expresion)
    {
        try {

            // sentencia sql
            $sql = "
            select 
                corredores.id,
                corredores.nombre, 
                corredores.apellidos,
                corredores.ciudad,
                corredores.sexo,
                timestampdiff(YEAR, corredores.fechaNacimiento, now()) as edad,
                corredores.email,
                corredores.dni,
                categorias.nombreCorto as categoria,
                clubs.nombreCorto as club
            FROM 
                corredores 
            INNER JOIN
                categorias
            ON corredores.id_categoria = categorias.id
            INNER JOIN
                clubs
            ON  corredores.id_club = clubs.id
            WHERE 
            CONCAT_WS(' ',
                        corredores.id, 
                        corredores.nombre,
                        corredores.apellidos, 
                        corredores.ciudad, 
                        corredores.sexo,
                        TIMESTAMPDIFF(YEAR, corredores.fechaNacimiento, NOW()),
                        corredores.email, 
                        corredores.dni,
                        categorias.nombreCorto,
                        clubs.nombreCorto) 
            LIKE ?

            ORDER BY corredores.id
        ";

            // ejecuto prepare
            $stmt = $this->db->prepare($sql);


            // arreglamos expresión para operador like
            $expresion = '%' . $expresion . '%';

            // vincular parámetros
            $stmt->bind_param(
                's',
                $expresion
            );

            // ejecutamos
            $stmt->execute();

            // Devolvemos objeto de la clase  mysqli_result
            $result = $stmt->get_result();

            // Devolvemos mysqli_result
            return $result;

        } catch (mysqli_sql_exception $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';


            // libero stmt
            $stmt->close();

            // libero result
            $result->close();

            // cierro conexión
            $this->db->close();

            // cancelo ejecución programa
            exit();
        }

    }

    /*
        método: delete()
        descripcion: elimina los 
        detalles de los corredores  ordenados por un criterio.
    */

    public function delete(int $id)
    {
        try {

            // sentencia sql
            $sql = "DELETE FROM corredores WHERE id = ? LIMIT 1";

            // ejecuto prepare
            $stmt = $this->db->prepare($sql);

            // vincular parámetros
            $stmt->bind_param(
                'i',
                $id
            );

            // ejecutamos
            $stmt->execute();

            // Devolvemos objeto de la clase  mysqli_result
            $result = $stmt->get_result();

            // Devolvemos mysqli_result
            return $result;

        } catch (mysqli_sql_exception $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero stmt
            $stmt->close();

            // libero result
            $result->close();

            // cierro conexión
            $this->db->close();

            // cancelo ejecución programa
            exit();
        }
    }


}
