<?php

namespace App\Infrastructure;

use PDO;
use PDOException;
use RuntimeException;

class Database
{
    private static ?self $instance = null;

    private PDO $connection;

    private function __construct()
    {
        $rootDir = dirname(__DIR__, 1);
        $env = Env::load(dirname($rootDir));

        $host = $env->get('DB_HOST') ?? 'localhost';
        $port = $env->get('DB_PORT') ?? '3306';
        $dbName = $env->get('DB_NAME');
        $user = $env->get('DB_USER');
        $password = $env->get('DB_PASSWORD') ?? '';
        $charset = $env->get('DB_CHARSET') ?? 'utf8mb4';

        if ($dbName === null || $user === null) {
            throw new RuntimeException('Database configuration is incomplete.');
        }

        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=%s', $host, $port, $dbName, $charset);

        try {
            $this->connection = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $exception) {
            throw new RuntimeException('Unable to connect to the database: ' . $exception->getMessage(), 0, $exception);
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function fetchAll(string $sql, array $parameters = []): array
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute($parameters);

        return $statement->fetchAll();
    }

    public function fetchOne(string $sql, array $parameters = []): ?array
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute($parameters);

        $result = $statement->fetch();

        return $result === false ? null : $result;
    }

    public function execute(string $sql, array $parameters = []): int
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute($parameters);

        return $statement->rowCount();
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
