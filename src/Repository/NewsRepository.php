<?php

namespace App\Repository;

use App\Infrastructure\Database;
use InvalidArgumentException;

class NewsRepository
{
    private const DEFAULT_TABLE = 'news_eparhia';
    private const ALLOWED_TABLES = [
        'news_eparhia',
        'news_eparhia_cron',
        'news_mitropolia',
        'news'
    ];

    public function __construct(private readonly Database $database)
    {
    }

    public function count(string $table = self::DEFAULT_TABLE): int
    {
        $tableName = $this->sanitizeTable($table);
        $row = $this->database->fetchOne("SELECT COUNT(*) AS cnt FROM {$tableName}");

        return $row ? (int) $row['cnt'] : 0;
    }

    public function getPaginated(int $limit, int $offset, string $table = self::DEFAULT_TABLE): array
    {
        $tableName = $this->sanitizeTable($table);
        $limit = max(0, $limit);
        $offset = max(0, $offset);

        $sql = sprintf(
            'SELECT * FROM %s ORDER BY data DESC LIMIT %d, %d',
            $tableName,
            $offset,
            $limit
        );

        return $this->database->fetchAll($sql);
    }

    public function findByDate(string $date, string $table = self::DEFAULT_TABLE): ?array
    {
        $tableName = $this->sanitizeTable($table);

        return $this->database->fetchOne(
            "SELECT * FROM {$tableName} WHERE data = :data",
            [':data' => $date]
        );
    }

    public function findByLink(string $value, string $table): ?array
    {
        $tableName = $this->sanitizeTable($table);

        return $this->database->fetchOne(
            "SELECT * FROM {$tableName} WHERE link = :link LIMIT 1",
            [':link' => $value]
        );
    }

    public function incrementViews(string $date): void
    {
        $this->database->execute(
            'UPDATE news_eparhia SET views = views + 1 WHERE data = :data',
            [':data' => $date]
        );
    }

    public function create(string $date, string $url, string $title, string $summary): void
    {
        $this->database->execute(
            'INSERT INTO news (data, url, tema, kratko) VALUES (:data, :url, :tema, :kratko)',
            [
                ':data' => $date,
                ':url' => $url,
                ':tema' => $title,
                ':kratko' => $summary,
            ]
        );
    }

    public function attachVideo(string $date, string $videoHtml): void
    {
        $this->database->execute(
            'UPDATE news_eparhia SET video = :video WHERE data = :data',
            [
                ':data' => $date,
                ':video' => $videoHtml,
            ]
        );
    }

    public function findByVideoCode(string $videoHtml): ?array
    {
        return $this->database->fetchOne(
            'SELECT * FROM news_eparhia WHERE video = :video LIMIT 1',
            [':video' => $videoHtml]
        );
    }

    private function sanitizeTable(string $table): string
    {
        $tableName = strtolower($table);
        if (!in_array($tableName, self::ALLOWED_TABLES, true)) {
            throw new InvalidArgumentException('Unknown table requested: ' . $table);
        }

        return $tableName;
    }
}
