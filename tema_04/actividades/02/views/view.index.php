<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actividad 4.2 Calculadora Básica PHP - POO</title>

    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap Icons 1.11.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>


<body>
    <!-- Capa principal -->
    <div class="container">

        <header class="pb-3 mb-4 border-bottom">
            <span class="fs-5">
                <i class="bi bi-calculator-fill"></i>
                Actividad 4.2 Calculadora Básica PHP - POO
            </span>
        </header>

        <legend>Calculadora Básica PHP</legend>

        <form action="calcular.php" method="POST">
            <!-- Valor 1 -->
            <div class="mb-3">
                <label class="form-label">Valor 1</label>
                <input type="number" class="form-control" name="valor1" step="0.01" placeholder="0">
            </div>

            <!-- Valor 2 -->
            <div class="mb-3">
                <label class="form-label">Valor 2</label>
                <input type="number" class="form-control" name="valor2" step="0.01" placeholder="0">
            </div>

            <!-- Solución -->
            <div class="mb-3" hidden>
                <label class="form-label">Resultado</label>
                <input type="number" class="form-control" name="resultado" disabled>
            </div>


            <!-- Botones de Acción -->
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary" name="operacion" value="sumar">Sumar</button>
            <button type="submit" class="btn btn-primary" name="operacion" value="restar">Restar</button>
            <button type="submit" class="btn btn-primary" name="operacion" value="dividir">Dividir</button>
            <button type="submit" class="btn btn-primary" name="operacion" value="multiplicar">Multiplicar</button>
            <button type="submit" class="btn btn-primary" name="operacion" value="potencia">Potencia</button>

        </form>

    </div>

    </div>


    <!-- Pie del documento -->
    <footer class="footer mt-auto py-3 fixed-bottom bg-light">
        <div class="container">
            <span class="text-muted">© 2024
                Juan Manel Saborido Baena - DWES - 2º DAW - Curso 24/25</span>
        </div>
    </footer>

    <!-- Bootstrap Javascript y popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>