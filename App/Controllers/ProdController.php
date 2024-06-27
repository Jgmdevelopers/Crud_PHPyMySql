<?php
//require_once '../App/Models/Product.php';
require_once BASE_PATH . '/App/Models/Product.php';



class ProdController {
    
    public function __construct() {
        // Iniciar la sesión y verificar si el usuario está autenticado
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "auth/loginForm");
            exit();
        }
    }

    public function carga() {
      //  echo 'en el controlador: </br>';
        require_once(__DIR__ . '/../Views/carga.php');
    }

    public function agregar() {
        var_dump($_POST);
        // Validación y procesamiento para agregar un nuevo producto
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recibir y validar los datos del formulario
            $productName = $_POST['productName'] ?? '';
            $productDescription = $_POST['productDescription'] ?? '';
            $productPrice = $_POST['productPrice'] ?? '';
            
            // Validar la imagen y guardarla en la carpeta correspondiente
            if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
                $imageFileName = $_FILES['productImage']['name'];
                $imageTempPath = $_FILES['productImage']['tmp_name'];
                // Mover la imagen a la carpeta de destino
                $uploadDir = '../Public/uploads/';
                $imagePath = $uploadDir . $imageFileName;
                move_uploaded_file($imageTempPath, $imagePath);
            } else {
                // Manejar errores de carga de imagen
                echo "Error al cargar la imagen.";
                return;
            }
            
            // Ejemplo de cómo interactuar con el modelo Product
            $product = new Product();
            $result = $product->save($productName, $productDescription, $productPrice, $imagePath);
    
            if ($result) {
                // Redirigir a la lista de productos si se guarda correctamente
                header('Location: ../prod/listar');
                exit;
            } else {
                // Manejar el error si no se pudo guardar en la base de datos
                echo "Error al guardar el producto.";
            }
        }
    }
    

    public function listar() {

        $productModel = new Product();
        $products = $productModel->getAllProducts();
        
        require_once(__DIR__ . '/../Views/listProducts.php');
    }

    public function editar($id) {
        // Depuración para verificar el ID recibido
        //echo "Entre al controlador: prod/editar/" . $id . "<br>";
    
        // Crear una instancia del modelo Product
        $productModel = new Product();
    
        // Obtener el producto por ID
        $product = $productModel->getProductById($id);
    
        // Depuración para verificar el producto obtenido
        //echo "Producto es: " . htmlspecialchars(print_r($product, true)) . "<br>";
    
        // Verificar si se encontró el producto
        if ($product) {
            // Si el producto existe, cargar la vista de edición
            require_once(__DIR__ . '/../Views/edit_product.php');
        } else {
            // Si el producto no existe, mostrar un mensaje de error
            echo "Producto no encontrado.";
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar los datos del formulario
            $nombre = $_POST['name'];
            $descripcion = $_POST['description'];
            $precio = $_POST['price'];
    
            // Manejar la carga de la imagen
            $imagen = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $target_dir = "../Public/uploads/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $imagen = $target_file;
                }
            }
    
            // Crear una instancia del modelo Product
            $productModel = new Product();
    
            // Actualizar el producto en la base de datos
            $updated = $productModel->updateProduct($id, $nombre, $descripcion, $precio, $imagen);
    
            if ($updated) {
                // Redirigir a la página de listar productos
                header('Location: ' . BASE_URL . 'prod/listar');
                exit;
            } else {
                // Mostrar un mensaje de error
                echo "Error al actualizar el producto.";
            }
        }
    }

    public function delete($id) {
        // Verificar si se recibió una solicitud POST para eliminar el producto
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear una instancia del modelo Product
            $productModel = new Product();
    
            // Intentar eliminar el producto por su ID
            $deleted = $productModel->deleteProduct($id);
    
            if ($deleted) {
                // Redirigir a la página de listar productos
                header('Location: ' . BASE_URL . 'prod/listar');
                exit;
            } else {
                // Mostrar un mensaje de error si no se pudo eliminar
                echo "Error al eliminar el producto.";
            }
        } else {
            // Mostrar un mensaje de error si no se recibió una solicitud POST
            echo "Acción no permitida.";
        }
    }
    public function buscar() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
            $searchTerm = strtolower($_GET['search']); // Convertir a minúsculas
        
            // Validar que el término de búsqueda no esté vacío
            if (!empty($searchTerm)) {
                // Crear una instancia del modelo Product
                $productModel = new Product();
        
                // Obtener productos por nombre o descripción
                $products = $productModel->searchProducts($searchTerm);
        
                // Mostrar resultados (puedes redirigir a una vista o imprimir directamente aquí)
                if (!empty($products)) {
                    // Mostrar resultados en la vista
                    require_once(__DIR__ . '/../Views/listProducts.php');
                } else {
                    // Mostrar mensaje en la misma página de búsqueda
                    $searchMessage = "No se encontraron productos con el término de búsqueda '" . htmlspecialchars($searchTerm) . "'.";
                    require_once(__DIR__ . '/../Views/dashboard.php');
                }
            } else {
                echo "Por favor, ingresa un término de búsqueda.";
            }
        } else {
            echo "Método de solicitud no válido.";
        }
    }
    
    
    
    
    
    
    
    
    
   
}

?>
