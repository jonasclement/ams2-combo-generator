<?php

namespace App\Livewire\ComboGenerator;

use App\Enums\TagEnum;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Filters extends Component
{
    private const COOKIE_VERSION = 1;

    /** @var "track"|"car" */
    public string $type;

    /** @var array<value-of<TagEnum>, bool> */
    public array $filters;

    public function mount()
    {
        $validated = $this->validate([
            'type' => ['required', Rule::in(['track', 'car'])],
            'filters' => ['required', Rule::array(TagEnum::cases())],
            'filters.*' => 'required|boolean',
        ]);

        $this->type = $validated['type'];
        $this->filters = $validated['filters'];
    }

    public function render()
    {
        return view('livewire.combo-generator.filters');
    }

    public function updatedFilters(): void
    {
        Cookie::queue(Cookie::forever($this->getCookie(), serialize($this->filters)));
    }

    private function getCookie(): string
    {
        return $this->type . 'Filters' . self::COOKIE_VERSION;
    }
}
