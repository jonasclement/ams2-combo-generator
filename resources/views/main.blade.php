<x-layout>
  <h1 class="display-2">{{ config('app.name') }}</h1>

  <p class="lead">{{ __('main.lead') }}</p>

  <div class="mt-4">
    <livewire:combo-generator />
  </div>
</x-layout>
