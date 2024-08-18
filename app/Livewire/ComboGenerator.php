<?php

namespace App\Livewire;

use App\Enums\TagEnum;
use App\Models\Track;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class ComboGenerator extends Component
{
    private const COOKIE_TRACK_FILTERS = 'trackFilters';
    private const COOKIE_CAR_FILTERS = 'carFilters';
    private const COOKIE_VERSION = 1;

    /** @var array<value-of<TagEnum>, bool> */
    public array $trackFilters = [];

    /** @var array<value-of<TagEnum>, bool> */
    public array $carFilters = [];

    public function mount(): void
    {
        $this->trackFilters = $this->initializeTrackFilters();
        $this->carFilters = $this->initializeCarFilters();
    }

    public function render(): View
    {
        return view('livewire.combo-generator');
    }

    private function initializeTrackFilters(): array
    {
        $cookie = self::COOKIE_TRACK_FILTERS . self::COOKIE_VERSION;
        if (Cookie::has($cookie)) {
            return unserialize(Cookie::get($cookie));
        }

        return [
            TagEnum::DLC->value => true,
            TagEnum::Kart->value => false,
            TagEnum::RallyCross->value => false
        ];
    }

    private function initializeCarFilters(): array
    {
        $cookie = self::COOKIE_CAR_FILTERS . self::COOKIE_VERSION;
        if (Cookie::has($cookie)) {
            return unserialize(Cookie::get($cookie));
        }

        return [
            TagEnum::DLC->value => false,
            TagEnum::Kart->value => false,
            TagEnum::RallyCross->value => false
        ];
    }
}
