<?php
// Cambia 'admin123' por la contraseña que quieras en el futuro
$mi_contrasena = 'admin123';
$mi_hash = password_hash($mi_contrasena, PASSWORD_DEFAULT);

echo "<h1>Generador de Hashes Seguros</h1>";
echo "<p>Tu contraseña: <b>" . $mi_contrasena . "</b></p>";
echo "<p>Copia este hash y pégalo en tu base de datos:</p>";
echo "<textarea rows='3' cols='70' readonly>" . $mi_hash . "</textarea>";
?>