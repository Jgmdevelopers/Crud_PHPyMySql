<?php

class HomeController {

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

    public function index() {
        // Mostrar la vista del dashboard
        require_once BASE_PATH . '/App/Views/dashboard.php';
    }
}

?>
