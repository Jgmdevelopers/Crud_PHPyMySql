<?php

require_once '../core/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Método para registrar un nuevo usuario
    public function register($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->db->query('INSERT INTO usuarios (username, email, password) VALUES (:username, :email, :password)');
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $hashedPassword);

        return $this->db->execute();
    }

    // Método para obtener información de usuario por nombre de usuario
    public function getUserByUsername($username) {
        $this->db->query('SELECT * FROM usuarios WHERE username = :username');
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    // Método para verificar si un usuario ya existe con el mismo nombre de usuario o correo electrónico
    public function checkUserExists($username, $email) {
        $this->db->query('SELECT * FROM usuarios WHERE username = :username OR email = :email');
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    // Método para verificar las credenciales de inicio de sesión
    public function login($username, $password) {
        $user = $this->getUserByUsername($username);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user; // Usuario autenticado correctamente
            }
        }
        return false; // Usuario o contraseña incorrectos
    }

   
}
