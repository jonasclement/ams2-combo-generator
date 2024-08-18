@props([
'filters',
'type'
])

@php
throw_unless(
in_array($type, ['track', 'car']),
\RuntimeException::class,
'The $type variable must be either "track" or "car".'
);
@endphp

<div class="row">
  @foreach($filters as $key => $value)
  @php
  $name = 'allow' . $type . ucfirst($key);
  $label = __('generator.filter.' . strtolower($key));
  @endphp

  <div class="col-12">
    <input type="checkbox" class="form-check-input" name="{{ $name }}" id="{{ $name }}" wire:model.live="{{ "filters.{$key}" }}" />
    <label for="{{ $name }}" class="form-check-label">{{ $label }}</label>
  </div>
  @endforeach
</div>
