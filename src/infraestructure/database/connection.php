<?php
namespace App\Infraestructure\Database;

use PDO;
use Exception;
use App\Infraestructure\Exceptions\DBErrorException;

// TODO MIGRAR A DOTENV

class Connection {
    private $pdo;

    public function __construct(array $conf) {
        try{
            $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s',
                $conf['host'], $conf['port'], $conf['name'], $conf['charset']
            );
            $this->pdo = new PDO($dsn, $conf['user'], $conf['pass'], [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);

        } catch (Exception $e) {
            throw new DBErrorException("Conexion a la BBDD fallida");
        }
    }

    public function getConnection() : PDO {
        return $this->pdo;
    }

    public function close() : void {
        $this->pdo = null;
    }

    public function connect(array $conf) {
        try{
            $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s',
                $conf['host'], $conf['port'], $conf['name'], $conf['charset']
            );
            $this->pdo = new PDO($dsn, $conf['user'], $conf['pass'], [
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