<?php

namespace Database\Builder\Contract;

interface SqlQueryBuilder
{
  public function insert(string $table, array $values): self;

  public function select(string $table, array $fields): self;

  public function update(string $table, array $fields): self;

  public function delete(string $table): self;

  public function where(string $field, string $operator): self;

  public function limit(int $start, int $offset): self;

  public function getQuery(): string;
}
