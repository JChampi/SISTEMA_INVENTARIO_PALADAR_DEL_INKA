<?php
// 1. Iniciamos/Retomamos la sesión actual
session_start();

// 2. Vaciamos todas las variables de sesión
$_SESSION = array();

// 3. Destruimos la sesión en el servidor
session_destroy();

// 4. Redirigimos al usuario de vuelta a la página de login
header("Location: login.php");
exit();
?>