<?php

namespace App\Service;

use App\Infrastructure\Database;
use App\Repository\NewsRepository;
use App\Repository\ScheduleRepository;

class ScheduleService
{
    private ScheduleRepository $repository;
    private NewsRepository $newsRepository;
    private ?int $countCache = null;
    private array $paginatedCache = [];

    public function __construct(?ScheduleRepository $repository = null, ?NewsRepository $newsRepository = null)
    {
        $database = Database::getInstance();
        $this->repository = $repository ?? new ScheduleRepository($database);
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

    public function createEntry(string $service, string $church, string $day, string $month, string $year): void
    {
        $monthNumber = $this->normalizeMonth($month);
        $dayFormatted = str_pad($day, 2, '0', STR_PAD_LEFT);
        $dateKey = sprintf('%s.%s.%s', $year, $monthNumber, $dayFormatted);
        $humanDate = sprintf('%s %s', $day, $month);

        $weekday = $this->resolveWeekday($dayFormatted, $monthNumber, $year);
        $text = $this->buildServiceDescription($service, $church);
        $text = $this->applyAbbreviations($text);

        $this->repository->create($dateKey, $humanDate, $weekday, $text, '', null);
    }

    public function getPrihods(): array
    {
        return $this->repository->getPrihods();
    }

    public function findCover(string $sluzba): ?string
    {
        if ($sluzba === '') {
            return null;
        }

        if (preg_match('/^https?:\/\//i', $sluzba)) {
            $news = $this->newsRepository->findByLink($sluzba, 'news_mitropolia');
            if ($news && !empty($news['oblozka'])) {
                return $news['oblozka'];
            }

            return null;
        }

        foreach (['news_mitropolia', 'news_eparhia', 'news_eparhia_cron'] as $table) {
            $news = $this->newsRepository->findByDate($sluzba, $table);
            if ($news && !empty($news['oblozka'])) {
                return $news['oblozka'];
            }
        }

        return null;
    }

    private function normalizeMonth(string $month): string
    {
        $normalized = mb_strtolower(trim($month), 'UTF-8');
        $map = [
            '01' => '01', '1' => '01', 'января' => '01',
            '02' => '02', '2' => '02', 'февраля' => '02',
            '03' => '03', '3' => '03', 'марта' => '03',
            '04' => '04', '4' => '04', 'апреля' => '04',
            '05' => '05', '5' => '05', 'мая' => '05',
            '06' => '06', '6' => '06', 'июня' => '06',
            '07' => '07', '7' => '07', 'июля' => '07',
            '08' => '08', '8' => '08', 'августа' => '08',
            '09' => '09', '9' => '09', 'сентября' => '09',
            '10' => '10', 'октября' => '10',
            '11' => '11', 'ноября' => '11',
            '12' => '12', 'декабря' => '12',
        ];

        return $map[$normalized] ?? str_pad((string) ((int) $normalized), 2, '0', STR_PAD_LEFT);
    }

    private function resolveWeekday(string $day, string $month, string $year): string
    {
        $dateString = sprintf('%s-%s-%s', $year, $month, $day);
        $weekday = (int) date('w', strtotime($dateString));

        $days = ['ВС', 'ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ'];

        return $days[$weekday] ?? '';
    }

    private function buildServiceDescription(string $service, string $church): string
    {
        $service = trim($service);
        $church = trim($church);

        if ($church === '') {
            return $service;
        }

        $prihod = $this->repository->findPrihodByName($church);
        if ($prihod) {
            return sprintf('%s. <a href="prihod.php?id=%s">%s</a>', $service, $prihod['id'], $church);
        }

        if ($church === 'Жадовский монастырь') {
            return sprintf('%s. <a href="mon.php">Жадовский монастырь</a>', $service);
        }

        return sprintf('%s. %s', $service, $church);
    }

    private function applyAbbreviations(string $text): string
    {
        $patterns = [
            '/великомученика/u',
            '/святителя/u',
            '/мучениц/u',
            '/святого/u',
            '/святых/u',
            '/священномученика/u',
            '/равноапостольных/u',
            '/апостола/u',
            '/преподобного/u',
        ];

        $replace = ['вмч.', 'свт.', 'мц.', 'св.', 'свв.', 'сщмч.', 'равноап.', 'ап.', 'прп.'];

        return preg_replace($patterns, $replace, $text) ?? $text;
    }
}
