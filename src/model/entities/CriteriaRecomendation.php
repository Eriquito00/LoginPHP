<?php 
namespace App\Model\Entities;

use App\Model\Exceptions\WrongCriteriaException;

class CriteriaRecomendation {
    private const MAX_SIZE = 10; // TAMBIEN ES DEFAULT SIZE
    private const DEFAULT_PAGE = 1;
    private const DEFAULT_ORDER = "created_at";
    private const DEFAULT_SENTIDO = "desc";
    private const ALLOWED_ORDER = ["created_at"];
    private const ALLOWED_SENTIDO = ["ASC", "DESC"];

    private int $page;
    private int $size;
    private string $username;
    private string $ordenarPor;
    private string $sentido;

    public function __construct(int $page = self::DEFAULT_PAGE, int $size = self::MAX_SIZE, string $username = '', string $ordenarPor = self::DEFAULT_ORDER, string $sentido = self::DEFAULT_SENTIDO)
    {
        // Normalizamos numeros y alguna entrada de datos posible:
        $this->page = max(1, $page);
        $this->size = max(1, min($size, self::MAX_SIZE));

        // Seteamos username por si hay user por el que filtrar
        $this->username = $this->normalizeString($username);

        // Comporvaciones de los parametros con dominio marcado
        if(in_array($ordenarPor, self::ALLOWED_ORDER, true)) {
            $this->ordenarPor = $ordenarPor;
        } else {
            throw new WrongCriteriaException("Order specified incorrect");
        }

        if(in_array(strtoupper($sentido), self::ALLOWED_SENTIDO, true)) {
            $this->sentido = strtoupper($sentido);
        } else {
            throw new WrongCriteriaException("Direction specified incorrect");
        }
    }

    private function normalizeString(string $str) : string | null{
        $r = $str == null ? null : trim($str);
        return $r === '' ? null : $r;
    }

    public function getPage() : int {
        return $this->page;
    }

    public function setPage(int $page) {
        $this->page = $page;
    }

    public function getSize() : int {
        return $this->size;
    }

    public function getUsername() : string {
        return $this->username;
    }

    public function getOrden() : string {
        return $this->ordenarPor;
    }

    public function getSentido() : string {
        return $this->sentido;
    }
}
?>
