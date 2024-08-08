<?php

namespace App;

use App\Exceptions\MissingDataFileException;
use Illuminate\Support\Facades\Storage;
use JsonException;

trait GameDataTrait
{
    private const DISK = 'ams2-data';

    /**
     * @return array<string, mixed>[]
     *
     * @throws MissingDataFileException
     * @throws JsonException
     */
    private function getGameData(string $file): array
    {
        if (!Storage::disk(self::DISK)->exists($file)) {
            $path = Storage::disk(self::DISK)->path($file);
            throw new MissingDataFileException("Data file not found. Please make sure that {$path} exists.");
        }

        // preg_replace to remove unprintable characters
        $json = preg_replace('/[[:^print:]]/', '', Storage::disk(self::DISK)->get($file));

        $data = json_decode($json, true, flags: JSON_THROW_ON_ERROR);
        return $data['response']['list'];
    }

    /** @param array<string, mixed> $data */
    private function hashData(array $data): string
    {
        return md5(serialize($data));
    }

    /** @param array<string, mixed> $data */
    private function hasDataChanged(array $data, bool $force = false): bool
    {
        if ($force) {
            return true;
        }

        if (!Storage::exists($this->getCacheFile())) {
            return true;
        }

        $cachedHash = Storage::get($this->getCacheFile());
        $currentHash = $this->hashData($data);
        return $cachedHash !== $currentHash;
    }

    /** @param array<string, mixed> $data */
    private function cacheDataHash(array $data): void
    {
        Storage::put($this->getCacheFile(), $this->hashData($data));
    }

    private function getCacheFile(): string
    {
        return basename(get_class($this)) . '.cache.md5';
    }
}
