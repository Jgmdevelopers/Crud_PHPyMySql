<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Nuevo Producto</title>
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/product-form.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/app.css">
    <script src="<?php echo ASSETS_PATH_JS; ?>app.js"></script>
    
</head>

<body>
    <header>
        <h2>Cargar Nuevo Producto</h2>
    </header>

    <div class="container">
        <div class="form">
            <form action="../prod/agregar" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="productName">Nombre del Producto:</label>
                    <input type="text" id="productName" name="productName" required>
                </div>
                <div class="form-group">
                    <label for="productDescription">Descripción del Producto:</label>
                    <textarea id="productDescription" name="productDescription" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="productPrice">Precio:</label>
                    <input type="number" id="productPrice" name="productPrice" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="productImage">Imagen del Producto:</label>
                    <input type="file" id="productImage" name="productImage" accept="image/*" required onchange="previewImage(event)">
                </div>
                <div class="form-group image-preview-container">
                    <img id="image-preview" class="image-preview" src="#" alt="Vista previa de la imagen" style="display: none;">
                </div>
                <div class="form-group">
                    <button type="submit">Cargar Producto</button>
                </div>
                <button type="button" onclick="goBack()" style="padding: 10px 20px; background-color: #f44336; color: white; border: none; cursor: pointer; border-radius: 5px;">Atrás</button>
    
            </form>
        </div>
    </div>
    <?php
    include 'components/footer.php';
    ?>

</body>


</html>
