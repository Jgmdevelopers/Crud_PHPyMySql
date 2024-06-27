<?php
require_once __DIR__ . '/../../config.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>dashboard.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/app.css">
    <script src="<?php echo ASSETS_PATH_JS; ?>app.js"></script>
    <style>
        .search-message {
            color: red;
            margin-top: 10px;
        }
    </style>


</head>

<body>
    <header>
        <h2>Bienvenido al Sistema</h2>
    </header>

    <div class="container">
        <section class="dashboard-options">
            <h3>Opciones:</h3>
            <ul>
                <li><a href="<?php echo BASE_URL; ?>prod/carga">Cargar Nuevo Producto</a></li>
                <li>
                    <a href="#" onclick="toggleSearchForm()">Buscar Producto</a>
                    <?php if (isset($searchMessage)) : ?>
                        <p class="search-message"><?php echo $searchMessage; ?></p>
                    <?php endif; ?>
                    <div id="searchForm" style="display: none;">
                        <form action="<?php echo BASE_URL; ?>prod/buscar" method="GET">
                            <label for="search">Buscar por nombre:</label>
                            <input type="text" id="search" name="search" required>
                            <button type="submit">Buscar</button>
                        </form>

                    </div>
                </li>
                <li><a href="<?php echo BASE_URL; ?>prod/listar">Ver Listado de Productos</a></li>
            </ul>
            <form action="<?php echo BASE_URL; ?>auth/logout" method="POST">
                <button type="submit" name="logout" style="padding: 10px 20px; background-color: #f44336; color: white; border: none; cursor: pointer; border-radius: 5px;">Salir</button>

            </form>
        </section>




    </div>
    <?php
    include 'components/footer.php';
    ?>

</body>

</html>