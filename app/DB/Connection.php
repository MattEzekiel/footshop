<?php
namespace App\DB;

use PDO;
use PDOException;

class Connection
{
    protected static $host = "localhost";
    protected static $user = "root";
    protected static $pass = "";
    protected static $base = "footshop";
    protected static $db;

    /**
     * @return PDO
     */
    public static function getConnection(): PDO
    {
        if(self::$db === null) {
            try {

                self::$db = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$base . ";charset=utf8mb4", self::$user, self::$pass);

                /*echo 'La conexión ha sido un éxito.';*/

                self::$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            } catch(PDOException $e) {

                echo "No se pudo conectar a la base.";
                exit;
            }
        }
        return self::$db;
    }
}
