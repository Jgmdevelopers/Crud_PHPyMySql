<?php
require_once __DIR__ . '/../../config.php';

class DashboardController {

    public function __construct() {
        // Iniciar la sesión y verificar si el usuario está autenticado
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header("Location: Auth/loginForm");
            exit();
        }
    }

    public function index() {
        // Verifica que el usuario esté autenticado
       
        if (!isset($_SESSION['user_id'])) {
            header("Location: ../Auth/loginForm");
            exit();
        }

        // Mostrar la vista del dashboard
        include_once '../App/Views/dashboard.php';
    }
  
}
