<?php

namespace App\Livewire\ComboGenerator;

use App\Enums\TagEnum;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Filters extends Component
{
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
        $this->dispatch('filtersUpdated', $this->type, $this->filters);
    }
}
