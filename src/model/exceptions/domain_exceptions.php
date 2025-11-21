<?php
namespace App\Model\Exceptions;
use DomainException;

class ModelException extends DomainException {}
class WrongCriteriaException extends ModelException {}
?>