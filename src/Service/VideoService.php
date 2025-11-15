<?php

namespace App\Service;

use App\Infrastructure\Database;
use App\Repository\NewsRepository;
use App\Repository\VideoRepository;

class VideoService
{
    private VideoRepository $repository;
    private NewsRepository $newsRepository;
    private ?int $countCache = null;
    private array $paginatedCache = [];

    public function __construct(?VideoRepository $repository = null, ?NewsRepository $newsRepository = null)
    {
        $database = Database::getInstance();
        $this->repository = $repository ?? new VideoRepository($database);
        $this->newsRepository = $newsRepository ?? new NewsRepository($database);
    }

    public function count(): int
    {
        if ($this->countCache === null) {
            $this->countCache = $this->repository->count();
        }

        return $this->countCache;
    }

    public function getPaginated(int $limit, int $offset): array
    {
        $cacheKey = sprintf('%d_%d', $limit, $offset);
        if (!array_key_exists($cacheKey, $this->paginatedCache)) {
            $this->paginatedCache[$cacheKey] = $this->repository->getPaginated($limit, $offset);
        }

        return $this->paginatedCache[$cacheKey];
    }

    public function create(string $title, string $html, bool $addToNews): void
    {
        $data = date('Y.m.d H:i');
        $normalizedHtml = preg_replace('/width="\d{2,3}" height="\d{2,3}"/i', 'width="46%"', $html);

        $this->repository->create($data, $title, $normalizedHtml);

        if ($addToNews) {
            $this->newsRepository->create($data, 'video', $title, 'Обновление раздела видео.');
        }
    }
}
