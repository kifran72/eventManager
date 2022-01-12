<?php

namespace App;

use PDO;

class FactoryPDO
{
    private static $pdo = null;

    private static $defaults = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
    ];

    public static function build(string $dns, string $username, string $password): \PDO
    {
        self::$pdo = new \PDO(
            $dns,
            $username,
            $password,
            self::$defaults
        );

        return self::$pdo;
    }

    public static function buildSqlite(string $dns): \PDO
    {

        return self::$pdo = new \PDO($dns);
    }

    public static function reset(): void
    {
        self::$pdo = null;
    }
}

// host: root
// pw: toor