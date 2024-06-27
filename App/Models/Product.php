<?php
require_once '../core/Database.php';

class Product
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $image;

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Getters y setters para los atributos

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    // Método para guardar el producto en la base de datos
    public function save($nombre, $descripcion, $precio, $imagen)
    {
        try {
            $this->db->query("INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (:nombre, :descripcion, :precio, :imagen)");
            $this->db->bind(':nombre', $nombre);
            $this->db->bind(':descripcion', $descripcion);
            $this->db->bind(':precio', $precio);
            $this->db->bind(':imagen', $imagen);

            return $this->db->execute();
        } catch (PDOException $e) {
            // Aquí puedes manejar cualquier excepción de base de datos
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    // Método para obtener todos los productos
    public function getAllProducts()
    {
        $this->db->query("SELECT * FROM productos");
        return $this->db->resultSet();
    }

    // Método para obtener un producto por su ID
    public function getProductById($id) {
        try {
            $this->db->query("SELECT * FROM productos WHERE id = :id");
            $this->db->bind(':id', $id);
            return $this->db->single(); // Asumiendo que single() devuelve un solo resultado
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

        
    }

    //método para buscar por nombre
   // Dentro de tu modelo Product (App/Models/Product.php)

    public function searchProducts($searchTerm) {
        try {
            $this->db->query("SELECT * FROM productos WHERE nombre LIKE :search OR descripcion LIKE :search");
            $this->db->bind(':search', '%' . $searchTerm . '%'); // Usamos LIKE para buscar nombres o descripciones que contengan el término
            return $this->db->resultSet(); // Asumiendo que resultSet() devuelve múltiples resultados
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return []; // Devolvemos un array vacío en caso de error
        }
    }

    

    public function updateProduct($id, $nombre, $descripcion, $precio, $imagen) {
        try {
            // Crear la consulta SQL
            $sql = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio";
            
            // Incluir la imagen solo si se ha subido una nueva
            if ($imagen) {
                $sql .= ", imagen = :imagen";
            }
    
            $sql .= " WHERE id = :id";
    
            // Preparar la consulta
            $this->db->query($sql);
    
            // Enlazar los parámetros
            $this->db->bind(':id', $id);
            $this->db->bind(':nombre', $nombre);
            $this->db->bind(':descripcion', $descripcion);
            $this->db->bind(':precio', $precio);
    
            if ($imagen) {
                $this->db->bind(':imagen', $imagen);
            }
    
            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Manejar cualquier excepción de base de datos
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function deleteProduct($id) {
        try {
            $this->db->query("DELETE FROM productos WHERE id = :id");
            $this->db->bind(':id', $id);
            return $this->db->execute();
        } catch (PDOException $e) {
            // Aquí puedes manejar cualquier excepción de base de datos
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    
}
