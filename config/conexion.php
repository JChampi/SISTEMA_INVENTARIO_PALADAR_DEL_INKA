<?php

class Conexion {
    // Credenciales por defecto del entorno local XAMPP
    private $host = 'localhost';
    private $db   = 'pizzeria_paladar_inka'; // El nombre exacto definido en tu script SQL
    private $user = 'root';
    private $pass = '';                      // En XAMPP, root viene sin contraseña por defecto
    private $charset = 'utf8mb4';            // Fundamental para coincidir con tu collation
    private $pdo;

    public function conectar() {
        // Solo creamos la conexión si no existe una previamente (Patrón Singleton básico)
        if ($this->pdo == null) {
            try {
                // Data Source Name (DSN)
                $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
                
                // Opciones de seguridad y formateo para PDO
                $options = [
                    // Lanza excepciones en caso de error (útil para try-catch)
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    // Devuelve los resultados como un array asociativo por defecto
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    // Desactiva la emulación de consultas preparadas (Seguridad 100% anti SQL-Injection)
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                // Instanciamos el objeto PDO
                $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
                
            } catch (PDOException $e) {
                // Si la conexión falla, detenemos la ejecución y mostramos el error
                // NOTA: En un entorno de producción real, cambiaríamos el die() por un error_log()
                die("Error crítico - No se pudo conectar a Pizzería El Paladar del Inka: " . $e->getMessage());
            }
        }
        
        return $this->pdo;
    }
}

// ==============================================================================
// CÓDIGO DE PRUEBA RÁPIDA (Puedes borrar esto una vez que verifiques que funciona)
// ==============================================================================

$con = new conexion();
$pdo = $con->conectar();

if ($pdo) {
    echo "<h1>¡Conexión exitosa a la base de datos 'pizzeria_paladar_inka'!</h1>";
    echo "<p>El sistema está listo para operar localmente.</p>";
}

?>