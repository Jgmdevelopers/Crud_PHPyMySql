<?php

// Importar la clase User
require_once '../App/Models/User.php';

class AuthController
{

    public function __construct()
    {
        // Iniciar la sesión al cargar el controlador
        session_start();
    }

    public function loginForm()
    {
        
        // Método para mostrar el formulario de inicio de sesión
        include_once '../App/Views/auth/login.php';
    }



    public function register()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Verificar campos vacíos
            if (empty(trim($_POST['username']))) {
                $errors['username'] = "El nombre de usuario es obligatorio.";
            }

            if (empty(trim($_POST['email']))) {
                $errors['email'] = "El correo electrónico es obligatorio.";
            }

            if (empty(trim($_POST['password']))) {
                $errors['password'] = "La contraseña es obligatoria.";
            }

            if (empty($errors)) {
                // Procesar datos del formulario de registro
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Validar y registrar usuario
                $userModel = new User();
                if (!$userModel->checkUserExists($username, $email)) {
                    if ($userModel->register($username, $email, $password)) {
                        // Registro exitoso, redirigir al usuario al formulario de login
                        header("Location: ../Auth/loginForm?success=1");
                        exit(); // Detener la ejecución después de redirigir
                    } else {
                        // Error al registrar
                        $errors['general'] = "Error al registrar. Inténtalo de nuevo.";
                    }
                } else {
                    // Usuario ya existe
                    $errors['general'] = "El usuario ya existe. Por favor, elige otro nombre de usuario o correo electrónico.";
                }
            }
        }

        // Mostrar formulario de registro con mensajes de error si los hay
        include_once '../App/Views/auth/register.php';
    }

    public function login()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Verificar campos vacíos
            if (empty($_POST['username']) || empty($_POST['password'])) {
                $errors['general'] = "Todos los campos son obligatorios.";
            } else {
                // Procesar datos del formulario de inicio de sesión
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Verificar credenciales
                $userModel = new User();
                $user = $userModel->login($username, $password);

                if ($user) {
                    
                   // Iniciar sesión y redirigir al panel de control
                   $_SESSION['user_id'] = $user['id'];
                   $_SESSION['username'] = $user['username'];
                   header("Location: ../Dashboard/index");
                   exit(); // Detener la ejecución después de redirigir
                } else {
                    $errors['general'] = "Usuario o contraseña incorrectos.";
                }
            }
        }

        // Mostrar formulario de inicio de sesión con mensaje de error si lo hay
        include_once '../App/Views/auth/login.php';
    }

    public function logout() {
        // Cerrar sesión
        session_start();
        session_unset();
        session_destroy();
        // Redirigir a la página de inicio o a otra página
        header("Location: ../Auth/loginForm");
        exit();
    }
}
