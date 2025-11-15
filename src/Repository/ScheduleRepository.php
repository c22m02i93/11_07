<?php

namespace App\Repository;

use App\Infrastructure\Database;

class ScheduleRepository
{
    public function __construct(private readonly Database $database)
    {
    }

    public function count(): int
    {
        $row = $this->database->fetchOne('SELECT COUNT(*) AS cnt FROM raspisanie');

        return $row ? (int) $row['cnt'] : 0;
    }

    public function getPaginated(int $limit, int $offset): array
    {
        $limit = max(0, $limit);
        $offset = max(0, $offset);

        $sql = sprintf(
            'SELECT * FROM raspisanie ORDER BY data DESC, (text+0) DESC LIMIT %d, %d',
            $offset,
            $limit
        );

        return $this->database->fetchAll($sql);
    }

    public function create(string $data, string $dataText, string $weekday, string $text, ?string $sluzba = null, ?string $extra = null): void
    {
        $this->database->execute(
            'INSERT INTO raspisanie VALUES (:data, :data_text, :weekday, :text, :sluzba, :extra)',
            [
                ':data' => $data,
                ':data_text' => $dataText,
                ':weekday' => $weekday,
                ':text' => $text,
                ':sluzba' => $sluzba,
                ':extra' => $extra,
            ]
        );
    }

    public function getPrihods(): array
    {
        return $this->database->fetchAll('SELECT * FROM prihods ORDER BY name');
    }

    public function findPrihodByName(string $name): ?array
    {
        return $this->database->fetchOne(
            'SELECT * FROM prihods WHERE name = :name LIMIT 1',
            [':name' => $name]
        );
    }
}
