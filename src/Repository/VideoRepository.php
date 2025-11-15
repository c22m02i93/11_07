<?php

namespace App\Repository;

use App\Infrastructure\Database;

class VideoRepository
{
    public function __construct(private readonly Database $database)
    {
    }

    public function count(): int
    {
        $row = $this->database->fetchOne('SELECT COUNT(*) AS cnt FROM video');

        return $row ? (int) $row['cnt'] : 0;
    }

    public function getPaginated(int $limit, int $offset): array
    {
        $limit = max(0, $limit);
        $offset = max(0, $offset);

        $sql = sprintf(
            'SELECT * FROM video ORDER BY id DESC LIMIT %d, %d',
            $offset,
            $limit
        );

        return $this->database->fetchAll($sql);
    }

    public function create(string $data, string $title, string $code): void
    {
        $this->database->execute(
            'INSERT INTO video VALUES (:id, :data, :title, :code)',
            [
                ':id' => null,
                ':data' => $data,
                ':title' => $title,
                ':code' => $code,
            ]
        );
    }
}
