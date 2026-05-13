<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso - El Paladar del Inka</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-container { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 300px; }
        .login-container h2 { text-align: center; color: #333; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; color: #666; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-submit { width: 100%; padding: 10px; background-color: #d32f2f; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; }
        .btn-submit:hover { background-color: #b71c1c; }
        .error-msg { color: #d32f2f; background-color: #fde0e0; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; text-align: center; }
    </style>
</head>
<body>

<div class="login-container">
    <h2>El Paladar del Inka</h2>
    
    <!-- Bloque para mostrar errores de validación -->
    <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'credenciales') echo "<div class='error-msg'>Correo o contraseña incorrectos.</div>";
            if ($_GET['error'] == 'nologin') echo "<div class='error-msg'>Debes iniciar sesión primero.</div>";
        }
    ?>

    <!-- Formulario que envía los datos a procesar_login.php por el método seguro POST -->
    <form action="procesar_login.php" method="POST">
        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required placeholder="admin@pizzeria.com">
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required placeholder="••••••••">
        </div>
        <button type="submit" class="btn-submit">Ingresar al Sistema</button>
    </form>
</div>

</body>
</html>