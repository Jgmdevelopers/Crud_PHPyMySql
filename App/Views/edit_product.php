<?php
require_once BASE_PATH . '/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/edit.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/app.css">

    <script src="<?php echo ASSETS_PATH_JS; ?>app.js"></script>

</head>
<body>
<header class="header">
        <h2>Editar Producto</h2>
    </header>
    <div class="container">
      
        <form action="<?php echo BASE_URL; ?>prod/update/<?php echo $product['id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?php echo $product['nombre']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="description">Descripción:</label>
                <textarea id="description" name="description" required><?php echo $product['descripcion']; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="price">Precio:</label>
                <input type="number" id="price" name="price" value="<?php echo $product['precio']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="image">Imagen:</label>
                <input type="file" id="image" name="image">
                <?php if ($product['imagen']): ?>
                    <img src="../../<?php echo $product['imagen']; ?>" alt="Imagen del producto" class="product-image">
                <?php endif; ?>
            </div>
            
            <button type="submit" class="btn">Actualizar</button>
            <button type="button" onclick="goBack()" style="padding: 10px 20px; background-color: #f44336; color: white; border: none; cursor: pointer; border-radius: 5px;">Cancelar</button>
        </form>
    </div>
    <?php
    include 'components/footer.php';
    ?>
</body>
</html>
