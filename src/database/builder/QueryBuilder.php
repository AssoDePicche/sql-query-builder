<?php

declare(strict_types=1);

namespace Database\Builder;

use Database\Builder\Contract\SqlQuery;
use Database\Builder\Contract\SqlQueryBuilder;
use Database\Builder\Enum\SqlStatement;
use Database\Builder\Exception\InvalidQueryException;

final class QueryBuilder implements SqlQueryBuilder
{
  private SqlQuery $query;

  public function clearQuery(): void
  {
    $this->query = new Query;
  }

  public function insert(string $table, array $fields): SqlQueryBuilder
  {
    $this->clearQuery();

    $binds = array_pad([], count($fields), '?');

    $this->query->setQuery('INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $binds) . ')');

    $this->query->setType(SqlStatement::INSERT);

    return $this;
  }

  public function select(string $table, array $fields): SqlQueryBuilder
  {
    $this->clearQuery();

    $this->query->setQuery('SELECT ' . implode(', ', $fields) . ' FROM ' . $table);

    $this->query->setType(SqlStatement::SELECT);

    return $this;
  }

  public function update(string $table, array $fields): SqlQueryBuilder
  {
    $this->clearQuery();

    $this->query->setQuery('UPDATE ' . $table . ' SET ' . implode(' = ?, ', $fields) . ' = ?');

    $this->query->setType(SqlStatement::UPDATE);

    return $this;
  }

  public function delete(string $table): SqlQueryBuilder
  {
    $this->clearQuery();

    $this->query->setQuery('DELETE FROM ' . $table);

    $this->query->setType(SqlStatement::DELETE);

    return $this;
  }

  public function where(string $field, string $operator): SqlQueryBuilder
  {
    $this->query->getType() === SqlStatement::INSERT && throw new InvalidQueryException;

    $this->query->setWhere($field . ' ' . $operator . ' ?');

    return $this;
  }

  public function limit(int $start, int $offset): SqlQueryBuilder
  {
    $this->query->getType() !== SqlStatement::SELECT && throw new InvalidQueryException;

    $this->query->setLimit(' LIMIT ' . $start . ', ' . $offset);

    return $this;
  }

  public function getQuery(): string
  {
    return $this->query->getQuery();
  }
}
