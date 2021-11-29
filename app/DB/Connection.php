<?php
namespace App\DB;

use App\Env\Loader;
use PDO;
use PDOException;

class Connection
{
    /*protected static $host = "localhost";
    protected static $user = "root";
    protected static $pass = "";
    protected static $base = "footshop";*/
    protected static $db;

    /**
     * @return PDO
     */
    public static function getConnection(): PDO
    {
        if(self::$db === null) {
            $host = Loader::getValue('DB_HOST');
            $base = Loader::getValue('DB_NAME');
            $user = Loader::getValue('DB_USER');
            $pass = Loader::getValue('DB_PASS');
            try {

                self::$db = new PDO("mysql:host=" . $host . ";dbname=" . $base . ";charset=utf8mb4", $user, $pass);

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
