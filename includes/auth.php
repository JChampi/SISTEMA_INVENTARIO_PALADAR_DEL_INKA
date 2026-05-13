<?php
// Auth.php
session_start();

class Auth {
    /**
     * Verifica si el usuario tiene permiso para ver una página.
     * @param array $rolesPermitidos Lista de roles que pueden entrar (ej: ['ADMIN', 'GERENTE'])
     */
    public static function verificarAcceso($rolesPermitidos = []) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php?error=nologin");
            exit();
        }

        if (!empty($rolesPermitidos) && !in_array($_SESSION['user_rol'], $rolesPermitidos)) {
            header("Location: dashboard.php?error=forbidden");
            exit();
        }
    }

    public static function esAdmin() {
        return isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'ADMIN';
    }
}