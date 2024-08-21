<?php

namespace App\Livewire;

use App\CarClassCombo;
use App\Enums\TagEnum;
use App\Models\Car;
use App\Models\CarTag;
use App\Models\Track;
use App\Models\TrackTag;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;
use InvalidArgumentException;
use Livewire\Attributes\On;
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

    private ?CarClassCombo $combo = null;

    public function mount(): void
    {
        $this->trackFilters = $this->initializeTrackFilters();
        $this->carFilters = $this->initializeCarFilters();
    }

    public function render(): View
    {
        return view('livewire.combo-generator', [
            'combo' => $this->combo
        ]);
    }

    public function generate(): void
    {
        $car = Car::all()
            ->filter((fn(Car $c) => $this->tagFilter($c, $this->carFilters)))
            ->random();

        /** @var Track */
        $track = Track::all()
            ->filter((fn(Track $t) => $this->tagFilter($t, $this->trackFilters)))
            ->random();

        $this->combo = new CarClassCombo($car, $track);
    }

    /** @param array<value-of<TagEnum>, bool> $filters */
    #[On('filtersUpdated')]
    public function updatedTrackFilters(string $type, array $filters): void
    {
        Cookie::queue(Cookie::forever($this->getCookieKey($type), serialize($filters)));
    }

    private function getCookieKey(string $type): string
    {
        return match ($type) {
            'track' => $this->getTrackCookieKey(),
            'car' => $this->getCarCookieKey(),
            default => throw new InvalidArgumentException("Invalid type: $type")
        };
    }

    private function getCarCookieKey(): string
    {
        return self::COOKIE_CAR_FILTERS . self::COOKIE_VERSION;
    }

    private function getTrackCookieKey(): string
    {
        return self::COOKIE_TRACK_FILTERS . self::COOKIE_VERSION;
    }

    private function initializeCarFilters(): array
    {
        $cookie = $this->getCarCookieKey();
        if (Cookie::has($cookie)) {
            return unserialize(Cookie::get($cookie));
        }

        return [
            TagEnum::DLC->value => false,
            TagEnum::Kart->value => false,
            TagEnum::RallyCross->value => false
        ];
    }

    private function initializeTrackFilters(): array
    {
        $cookie = $this->getTrackCookieKey();
        if (Cookie::has($cookie)) {
            return unserialize(Cookie::get($cookie));
        }

        return [
            TagEnum::DLC->value => true,
            TagEnum::Kart->value => false,
            TagEnum::RallyCross->value => false
        ];
    }

    /**
     * @param Builder $query
     * @param array<value-of<TagEnum>, bool> $filters
     */
    private function tagFilter(Car|Track $entity, array $filters): bool
    {
        foreach ($filters as $tag => $value) {
            if (!$value && $entity->tags->contains(fn(CarTag|TrackTag $tag) => $tag->tag === 'DLC')) {
                return false;
            }
        }

        return true;
    }
}
