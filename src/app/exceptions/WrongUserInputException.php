<?php

namespace App\Application\Exceptions;

use RuntimeException;

class WrongUserInputException extends RuntimeException {}
class LimitExceededException extends WrongUserInputException {}

class WrongUserIdException extends RuntimeException {}
class UserNotExistsException extends WrongUserIdException {}
?>