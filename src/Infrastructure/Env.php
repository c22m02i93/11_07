<?php

namespace App\Infrastructure;

use RuntimeException;

class Env
{
    private array $values;

    public function __construct(string $path)
    {
        if (!is_file($path)) {
            throw new RuntimeException(sprintf('.env file not found at %s', $path));
        }

        $this->values = $this->parseFile($path);
    }

    public static function load(string $directory): self
    {
        $envPath = rtrim($directory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '.env';

        return new self($envPath);
    }

    public function get(string $key, ?string $default = null): ?string
    {
        $upperKey = strtoupper($key);

        if (array_key_exists($upperKey, $this->values)) {
            return $this->values[$upperKey];
        }

        return $default;
    }

    private function parseFile(string $path): array
    {
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            throw new RuntimeException(sprintf('Unable to read .env file at %s', $path));
        }

        $values = [];
        foreach ($lines as $line) {
            $trimmed = trim($line);
            if ($trimmed === '' || str_starts_with($trimmed, '#')) {
                continue;
            }

            $pair = explode('=', $trimmed, 2);
            if (count($pair) !== 2) {
                continue;
            }

            [$key, $value] = $pair;
            $values[strtoupper(trim($key))] = trim($value);
        }

        return $values;
    }
}
