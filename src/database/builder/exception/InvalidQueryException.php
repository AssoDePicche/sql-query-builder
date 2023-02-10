<?php

declare(strict_types=1);

namespace Database\Builder\Exception;

use Exception;

final class InvalidQueryException extends Exception
{
  protected $message = 'Invalid query';
}
