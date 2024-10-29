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
                <input type="number" class="form-control" value="<?= $calculo->getValor1() ?>" disabled>
            </div>

            <!-- Valor 2 -->
            <div class="mb-3">
                <label class="form-label">Valor 2</label>
                <input type="number" class="form-control" value="<?= $calculo->getValor2() ?>" disabled>
            </div>

            <!-- Solución -->
            <div class="mb-3">
                <label class="form-label">Resultado</label>
                <input type="text" class="form-control"
                    value="<?= number_format($calculo->getResultado(), 2, ',', '.') ?>" disabled>
            </div>


            <!-- Botones de Acción -->
            <a role="button" class="btn btn-primary" href="index.php">Volver</a>

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