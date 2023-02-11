<?php

declare(strict_types=1);

namespace Test\Database\Builder;

use Database\Builder\Exception\InvalidQueryException;
use Database\Builder\QueryBuilder;
use PHPUnit\Framework\TestCase;

final class QueryBuilderTest extends TestCase
{
  public function test_insert_query(): void
  {
    $expected = 'INSERT INTO users (username) VALUES (?);';

    $builder = new QueryBuilder;

    $result = $builder->insert('users', ['username'])->getQuery();

    $this->assertEquals($expected, $result);
  }

  public function test_insert_query_with_where_should_throw_invalid_query_exception(): void
  {
    $this->expectException(InvalidQueryException::class);

    $builder = new QueryBuilder;

    $builder->insert('users', ['username'])->where('', '');
  }

  public function test_select_query_without_where_neither_limit(): void
  {
    $expected = 'SELECT username FROM users;';

    $builder = new QueryBuilder;

    $result = $builder->select('users', ['username'])->getQuery();

    $this->assertEquals($expected, $result);
  }

  public function test_select_query_with_where(): void
  {
    $expected = 'SELECT username FROM users WHERE username = ?;';

    $builder = new QueryBuilder;

    $result = $builder->select('users', ['username'])->where('username', '=')->getQuery();

    $this->assertEquals($expected, $result);
  }

  public function test_select_query_with_limit(): void
  {
    $expected = 'SELECT username FROM users LIMIT 0, 10;';

    $builder = new QueryBuilder;

    $result = $builder->select('users', ['username'])->limit(0, 10)->getQuery();

    $this->assertEquals($expected, $result);
  }

  public function test_update_query_with_where(): void
  {
    $expected = 'UPDATE users SET username = ? WHERE id = ?;';

    $builder = new QueryBuilder;

    $result = $builder->update('users', ['username'])->where('id', '=')->getQuery();

    $this->assertEquals($expected, $result);
  }

  public function test_delete_with_where(): void
  {
    $expected = 'DELETE FROM users WHERE id = ?;';

    $builder = new QueryBuilder;

    $result = $builder->delete('users')->where('id', '=')->getQuery();

    $this->assertEquals($expected, $result);
  }

  public function test_limit_in_a_non_select_statement_should_throw_invalid_query_exception(): void
  {
    $this->expectException(InvalidQueryException::class);

    $builder = new QueryBuilder;

    $builder->delete('users')->limit(0, 10);
  }
}
