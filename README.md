# SQL Query Builder

A module that allows you build and modify SQL queries in an easy way.

## How to Use

Instantiate the [Query Builder](src/database/builder/QueryBuilder.php) class and then start writing your commands with the object's methods. When you have finished writing your query use the getQuery() method, wich will return the sql query in a string.

```php
<?php

use Database\Builder\QueryBuilder;

$builder = new QueryBuilder;

// return 'SELECT username FROM users WHERE username = ? LIMIT 0, 10;'

$sql = $builder->select('users', ['username'])->where('username', '=')->limit(0, 10)->getQuery();

```

## Composer Commands

- **composer run tests**: Run all the tests in test directory
