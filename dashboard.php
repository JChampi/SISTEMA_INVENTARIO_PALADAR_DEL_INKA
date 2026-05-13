<?php
// 1. Requerimos el archivo de autenticación y validamos el acceso
require_once 'includes/Auth.php';

// Esta función verifica que exista una sesión. Si no la hay, redirige al login.
Auth::verificarAcceso(); 

// Extraemos los datos de la sesión para usarlos en la interfaz
$nombreUsuario = $_SESSION['user_nombre'];
$rolUsuario = $_SESSION['user_rol'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal - Pizzería El Paladar del Inka</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; }
        .navbar { background-color: #d32f2f; padding: 15px 20px; color: white; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { margin: 0; font-size: 20px; }
        .user-info { font-size: 14px; }
        .btn-logout { background-color: white; color: #d32f2f; text-decoration: none; padding: 8px 12px; border-radius: 4px; font-weight: bold; margin-left: 15px; }
        .btn-logout:hover { background-color: #fde0e0; }
        .container { padding: 20px; max-width: 1200px; margin: auto; }
        .grid-menu { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 30px; }
        .card { background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
    </style>
</head>
<body>

<div class="navbar">
    <h1>El Paladar del Inka - Sistema de Inventario</h1>
    <div class="user-info">
        <!-- Anti-XSS: Siempre usamos htmlspecialchars al imprimir datos del usuario en HTML -->
        <span>Bienvenido(a), <b><?= htmlspecialchars($nombreUsuario, ENT_QUOTES, 'UTF-8') ?></b> (<?= htmlspecialchars($rolUsuario, ENT_QUOTES, 'UTF-8') ?>)</span>
        <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
    </div>
</div>

<div class="container">
    <h2>Panel de Control</h2>
    <p>Selecciona un módulo para gestionar las operaciones de las sucursales.</p>

    <div class="grid-menu">
        <div class="card">
            <h3>📦 Catálogo de Insumos</h3>
            <p>Gestionar harinas, lácteos, carnes, etc.</p>
            <button>Ingresar</button>
        </div>
        <div class="card">
            <h3>📊 Kardex / Inventario</h3>
            <p>Ver entradas y salidas por sede.</p>
            <button>Ingresar</button>
        </div>
        
        <?php if ($rolUsuario === 'ADMIN' || $rolUsuario === 'GERENTE'): ?>
        <!-- Este bloque SOLO es visible para Administradores y Gerentes -->
        <div class="card" style="border: 2px solid #d32f2f;">
            <h3>👥 Gestión de Usuarios</h3>
            <p>Crear cuentas para operarios y contadores.</p>
            <button>Ingresar</button>
        </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>