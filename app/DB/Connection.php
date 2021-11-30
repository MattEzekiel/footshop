<?php
namespace App\DB;

use App\Env\Loader;
use App\Router;
use PDO;
use PDOException;

class Connection
{
    /**
     * @string DB
     */
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
                self::$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            } catch(PDOException $e) {
                Router::redirect('/500');
                exit;
            }
        }
        return self::$db;
    }
}
