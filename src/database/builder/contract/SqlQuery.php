<?php

declare(strict_types=1);

namespace Database\Builder\Contract;

interface SqlQuery
{
  public function setType(string $type): void;

  public function setQuery(string $query): void;

  public function setWhere(string $where): void;

  public function setLimit(string $limit): void;

  public function getType(): string;

  public function getQuery(): string;
}
