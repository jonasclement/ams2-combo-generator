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
    private function getTrackData(string $file): array
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
}
