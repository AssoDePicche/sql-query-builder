<?php

declare(strict_types=1);

namespace Database\Builder\Enum;

enum SqlStatement: string
{
  public const INSERT = 'INSERT';

  public const SELECT = 'SELECT';

  public const UPDATE = 'UPDATE';

  public const DELETE = 'DELETE';
}
