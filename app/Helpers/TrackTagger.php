<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Enums\TagEnum;
use App\Models\Track;

class TrackTagger
{
    /**
     * Add known tags to tracks
     *
     * @param Track $track
     * @param array<string, mixed> $rawData
     */
    public static function tag(Track $track, array $rawData): void
    {
        if (self::isDlc($rawData)) {
            $track->tags()->create(['tag' => TagEnum::DLC->value])->save();
        }

        if (self::isRallyCrossTrack($rawData)) {
            $track->tags()->create(['tag' => TagEnum::RallyCross->value])->save();
        }

        if (self::isKartingTrack($rawData)) {
            $track->tags()->create(['tag' => TagEnum::Kart->value])->save();
        }
    }

    private static function isDlc(array $rawData): bool
    {
        return isset($rawData['extra_data']['dlc']);
    }

    private static function isRallyCrossTrack(array $rawData): bool
    {
        if (!self::isDlc($rawData)) {
            return false;
        }

        return $rawData['extra_data']['dlc'] === 'Adrenaline Pack Pt.1';
    }

    private static function isKartingTrack(array $rawData): bool
    {
        return in_array($rawData['name'], [
            // Buskerud
            'Buskerud_Long',
            'Buskerud_Short',

            // Granja Viana
            'CopaSaoPauloStage2',
            'GranjaVianaKart101',
            'GranjaVianaKart102',
            'GranjaVianaKart121',

            // Interlagos
            'InterlagosKart1',
            'InterlagosKart2',
            'InterlagosKart3',

            // Londrina
            'Londrina_short',
            'Londrina_long',

            // Ortona
            'Ortona1',
            'Ortona2',
            'Ortona3',
            'Ortona4',

            // Speedland
            'Speedland1',
            'Speedland2',
            'Speedland3',
            'Speedland4',
        ]);
    }
}
