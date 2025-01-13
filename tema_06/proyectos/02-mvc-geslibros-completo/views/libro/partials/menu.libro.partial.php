<!-- menú principal Artículos -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= URL ?>libro">Libros</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= URL ?>libro/nuevo">Nuevo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= URL ?>libro/ordenar/1">Id</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>libro/ordenar/2">Titulo</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>libro/ordenar/3">Autor</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>libro/ordenar/4">Editorial</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>libro/ordenar/5">Genero</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>libro/ordenar/6">Stock</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>libro/ordenar/7">Precio</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>libro/ordenar/8">Fecha Edición</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>libro/ordenar/9">ISBN</a></li>
                    </ul>
                </li>

            </ul>
            <form class="d-flex" role="search" action="<?= URL ?>libro/filtrar" method="GET">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="expresion"
                    required>
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>