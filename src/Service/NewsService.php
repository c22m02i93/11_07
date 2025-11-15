<?php

namespace App\Service;

use App\Infrastructure\Database;
use App\Repository\NewsRepository;

class NewsService
{
    private NewsRepository $repository;
    private array $countCache = [];
    private array $paginatedCache = [];
    private array $itemCache = [];

    public function __construct(?NewsRepository $repository = null)
    {
        $this->repository = $repository ?? new NewsRepository(Database::getInstance());
    }

    public function count(string $table = 'news_eparhia'): int
    {
        if (!array_key_exists($table, $this->countCache)) {
            $this->countCache[$table] = $this->repository->count($table);
        }

        return $this->countCache[$table];
    }

    public function getPaginated(int $limit, int $offset, string $table = 'news_eparhia'): array
    {
        $cacheKey = sprintf('%s_%d_%d', $table, $limit, $offset);
        if (!array_key_exists($cacheKey, $this->paginatedCache)) {
            $this->paginatedCache[$cacheKey] = $this->repository->getPaginated($limit, $offset, $table);
        }

        return $this->paginatedCache[$cacheKey];
    }

    public function getByDate(string $date, string $table = 'news_eparhia'): ?array
    {
        $cacheKey = sprintf('%s_%s', $table, $date);
        if (!array_key_exists($cacheKey, $this->itemCache)) {
            $this->itemCache[$cacheKey] = $this->repository->findByDate($date, $table);
        }

        return $this->itemCache[$cacheKey];
    }

    public function incrementViews(string $date): void
    {
        $this->repository->incrementViews($date);
    }

    public function createDailyEntry(string $content): void
    {
        $now = date('Y.m.d H:i');
        $this->repository->create($now, '', '', $content);
    }

    public function findByVideoEmbed(string $videoHtml): ?array
    {
        return $this->repository->findByVideoCode($videoHtml);
    }
}
