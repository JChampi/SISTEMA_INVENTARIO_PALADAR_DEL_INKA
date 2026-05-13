<?php
// Iniciamos el sistema de sesiones de PHP
session_start();

// Llamamos a nuestra conexión (asegúrate de que la ruta coincida con tus carpetas)
require_once 'config/conexion.php';

// Verificamos que los datos vengan por POST (evita que entren escribiendo la URL directamente)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Sanitizamos y capturamos las variables
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    // 2. Validamos que el email tenga un formato correcto y la contraseña no esté vacía
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
        
        $con = new Conexion();
        $db = $con->conectar();
        
        // 3. Consulta Preparada: Buscamos al usuario por email
        $stmt = $db->prepare("SELECT id_usuario, nombre, password, rol, activo FROM usuario WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        // 4. Verificamos: ¿Existe el usuario? ¿Está activo? ¿Coincide la contraseña ingresada con el hash de la BD?
        if ($user && $user['activo'] == 1 && password_verify($password, $user['password'])) {
            
            // ¡ÉXITO! Regeneramos el ID de sesión por seguridad (Anti Session-Hijacking)
            session_regenerate_id(true);
            
            // Guardamos los datos importantes en la mochila de la sesión
            $_SESSION['user_id']     = $user['id_usuario'];
            $_SESSION['user_rol']    = $user['rol'];
            $_SESSION['user_nombre'] = $user['nombre'];
            
            // Redirigimos al panel principal
            header("Location: dashboard.php");
            exit(); // IMPORTANTE: Siempre colocar exit() después de un header location
            
        } else {
            // Falla la autenticación: Redirigimos de vuelta al login con mensaje de error
            header("Location: login.php?error=credenciales");
            exit();
        }
    } else {
        // Datos con formato inválido
        header("Location: login.php?error=credenciales");
        exit();
    }
} else {
    // Si intentan entrar a este archivo sin enviar un formulario, los devolvemos al login
    header("Location: login.php");
    exit();
}
?>