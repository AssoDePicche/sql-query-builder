<?php

declare(strict_types=1);

namespace Database\Builder;

use Database\Builder\Contract\SqlQuery;

final class Query implements SqlQuery
{
  private string $base = '', $limit = '', $type = '';

  private array $where = [];

  public function setType(string $type): void
  {
    $this->type = $type;
  }

  public function setQuery(string $query): void
  {
    $this->base = $query;
  }

  public function setWhere(string $where): void
  {
    $this->where[] = $where;
  }

  public function setLimit(string $limit): void
  {
    $this->limit = $limit;
  }

  public function getType(): string
  {
    return $this->type;
  }

  public function getQuery(): string
  {
    if (!empty($this->where)) {
      $this->base .= ' WHERE ' . implode(' AND ', $this->where);
    }

    if (isset($this->limit)) {
      $this->base .= $this->limit;
    }

    $this->base .= ';';

    return $this->base;
  }
}
