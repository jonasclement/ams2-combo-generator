<?php

declare(strict_types=1);

namespace App\Helpers;

class TrackTagger extends AbstractTagger
{
    protected function isKartingContent(): bool
    {
        return in_array($this->rawData['name'], [
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
