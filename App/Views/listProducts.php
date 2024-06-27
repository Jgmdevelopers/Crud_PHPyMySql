<?php require_once __DIR__ . '/../../config.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Productos</title>
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>product-list.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/app.css">
</head>

<body>
    <header class="header">
        <h2>Lista de Productos</h2>
    </header>

    <div class="container">
        <a href="<?php echo BASE_URL; ?>dashboard" class="btn">Ir al Menú Principal</a>
        <br><br>
        <?php if (!empty($products)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($product['descripcion']); ?></td>
                            <td>$<?php echo number_format($product['precio'], 2); ?></td>
                            <td><img src="../<?php echo htmlspecialchars($product['imagen']); ?>" alt="<?php echo htmlspecialchars($product['nombre']); ?>"></td>
                            <td>
                                <form action="<?php echo BASE_URL; ?>prod/delete/<?php echo $product['id']; ?>" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?')">Eliminar</button>
                                </form>
                                <a href="<?php echo BASE_URL; ?>prod/editar/<?php echo $product['id']; ?>" class="btn btn-edit">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No se encontraron productos.</p>
        <?php endif; ?>
    </div>
    <?php
    include 'components/footer.php';
    ?>

</body>

</html>
