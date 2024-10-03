<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto 2.2 - Lanzamiento Proyectiles</title>
    <!-- css bootstrap 532-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Iconos bootstrap 532 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body>
    <!-- Capa principal -->

    <div class="container">
        <!-- Cabecera -->
        <header style="background-color: #f0f0f0;" class="pb-3 mb-4 border-bottom">
            <i class="bi bi-balloon"></i>
            <span class="fs-6" style="font-size: larger; color: black;">Lanzamiento Proyectiles</span>
            <i class="bi bi-balloon"></i>
        </header>

        <legend style="color: black; background-color: #f0f0f0;">Inicio</legend>

        <!-- Formulario -->
        <form method="POST">
            <!-- Fin del formulario -->
            <!-- Valor 1 -->
            <!-- 
      En el input text cambiamos el tipo de dato que acepta 
      el step sirve para indicar la cantidad de decimales que acepta
      placeholder para que aparezca un valor por defecto
       -->
            <!-- Valor 1 -->

            <!-- Cada valor en el <input name = ""> Será el identificador del valor asignado -->

            <label for="velocidadInicial" class="form-label" id="velocidadInicial">Velocidad Inicial:</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" aria-label="Sizing example input" id="vInicial"
                    aria-describedby="inputGroup-sizing-default" step="0.01" placeholder="0.00" name="valor1">
            </div>
            <div id="velocidad" class="form-text">Velocidad en m/s</div>
            <br>
            <!-- Valor 2 -->
            <label for="anguloLanzamiento" class="form-label" id="anguloGrados">Ángulo Lanzamiento:</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" aria-label="Sizing example input" id="aGrados"
                    aria-describedby="inputGroup-sizing-default" step="0.01" placeholder="0.00" name="valor2">
            </div>
            <div id="angulosGrados" class="form-text">Ángulos en grados</div>
            <br>

            <!-- Botones de acción -->
            <div class="btn-group" role="group">
                <!-- Con el contenido de class, estamos indicando el color -->
                <!-- Añandimos el parametro form action y al darle al botón nos cargará la página del script calcular.php-->
                <button type="reset" class="btn btn-secondary">Borrar</button>
                <button type="submit" class="btn btn-primary" formaction="calcular.php">Calcular</button>
            </div>
        </form>

        <!-- Pie de documento -->
        <footer class="footer mt-auto py-3 fixed-bottom bg-light">
            <div class="container">
                <span class="text-muted">@ 2024
                    Juan Manuel Saborido Baena - DWES - 2º DAW - Curso 24/25
                </span>
            </div>
        </footer>
    </div>


    <!-- js bootstrap 532-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>