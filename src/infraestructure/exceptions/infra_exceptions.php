<?php 
namespace App\Infraestructure\Exceptions;

use RuntimeException;

class InfraestructureException extends RuntimeException {}
class DBErrorException extends InfraestructureException {}
class DataConflictException extends InfraestructureException {}
?>