<?php
namespace App\Infraestructure\Database;

use PDO;
use Exception;
use App\Infraestructure\Exceptions\DBErrorException;

class Connection {
    private static $instance = null;
    private $pdo;

    public function __construct() {
        try{
            $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s',
                $_ENV["MYSQL_HOST"], $_ENV["MYSQL_PORT"], $_ENV["MYSQL_DBNAME"], $_ENV["MYSQL_CHARSET"]
            );
            $this->pdo = new PDO($dsn, $_ENV["MYSQL_USER"], $_ENV["MYSQL_PASSWORD"], [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);

        } catch (Exception $e) {
            throw new DBErrorException("Conexion a la BBDD fallida");
        }
    }

    public static function getInstance() : self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() : PDO {
        return $this->pdo;
    }

    public function close() : void {
        $this->pdo = null;
    }

    public function connect() {
        try{
            $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s',
                $_ENV["MYSQL_HOST"], $_ENV["MYSQL_PORT"], $_ENV["MYSQL_DBNAME"], $_ENV["MYSQL_CHARSET"]
            );
            $this->pdo = new PDO($dsn, $_ENV["MYSQL_USER"], $_ENV["MYSQL_PASSWORD"], [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);

        } catch (Exception $e) {
            throw new DBErrorException("Conexion a la BBDD fallida");
        }
    }
}
?>