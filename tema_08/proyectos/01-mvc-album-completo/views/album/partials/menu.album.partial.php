<!-- menú principal Artículos -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
                <a class="navbar-brand" href="<?= URL ?>album">Albumes</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                        <a class="nav-link 
                    <?= in_array($_SESSION['role_id'], $GLOBALS['album']['nuevo']) ? 'active' : 'disabled' ?>"
                                                aria-current="page" href="<?= URL ?>album/nuevo">Nuevo</a>
                                </li>
                                <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle
                     <?= in_array($_SESSION['role_id'], $GLOBALS['album']['ordenar']) ? 'active' : 'disabled' ?>"
                                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Ordenar
                                        </a>
                                        <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                                href="<?= URL ?>album/ordenar/1/<?= $_SESSION['csrf_token'] ?>">Id</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                                href="<?= URL ?>album/ordenar/2/<?= $_SESSION['csrf_token'] ?>">Titulo</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                                href="<?= URL ?>album/ordenar/3/<?= $_SESSION['csrf_token'] ?>">Descripcion</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                                href="<?= URL ?>album/ordenar/4/<?= $_SESSION['csrf_token'] ?>">Autor</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                                href="<?= URL ?>album/ordenar/5/<?= $_SESSION['csrf_token'] ?>">Fecha</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                                href="<?= URL ?>album/ordenar/6/<?= $_SESSION['csrf_token'] ?>">Lugar</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                                href="<?= URL ?>album/ordenar/7/<?= $_SESSION['csrf_token'] ?>">Categoria</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                                href="<?= URL ?>album/ordenar/8/<?= $_SESSION['csrf_token'] ?>">Etiquetas</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                                href="<?= URL ?>album/ordenar/9/<?= $_SESSION['csrf_token'] ?>">Númerode fotos
                                                                de Fotos</a></li>
                                                <li><a class="dropdown-item"
                                                                href="<?= URL ?>album/ordenar/10/<?= $_SESSION['csrf_token'] ?>">Número de visitas
                                                                de Visitas</a></li>
                                                <li><a class="dropdown-item"
                                                                href="<?= URL ?>album/ordenar/11/<?= $_SESSION['csrf_token'] ?>">Carpetas</a>
                                                </li>
                                        </ul>
                                </li>

                        </ul>
                        <form class="d-flex" role="search" action="<?= URL ?>album/filtrar" method="GET">

                                <!-- protección CSRF -->
                                <input type="hidden" name="csrf_token"
                                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
                                <!-- expresion -->
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                                        name="expresion" required>
                                <!-- botones de acción -->
                                <button class="btn btn-outline-primary
                    <?= in_array($_SESSION['role_id'], $GLOBALS['album']['filtrar']) ? null : 'disabled' ?>" type="
                    submit">Buscar</button>
                        </form>
                </div>
        </div>
</nav>