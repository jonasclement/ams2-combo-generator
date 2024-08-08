<?php

declare(strict_types=1);

namespace App\Helpers;

class CarTagger extends AbstractTagger
{
    protected function isKartingContent(): bool
    {
        return in_array($this->rawData['class'], [
            'Kart125cc',
            'KartRental',
            'KartGX390',
            'KartShifter',
            'SuperKart',
            'Kartcross'
        ]);
    }
}
