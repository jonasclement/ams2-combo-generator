<div>
  <form wire:submit="generate">
    <fieldset class="mb-3 row">
      <legend class="col-12 col-sm-4 col-form-legend">{{ __('generator.legend.carFilter') }}</legend>
      <div class="col-12 col-sm-8">
        <div class="row">
          <livewire:combo-generator.filters :filters="$carFilters" type="car" />
        </div>
      </div>
    </fieldset>

    <hr />

    <fieldset class="mb-3 row">
      <legend class="col-12 col-sm-4 col-form-legend">{{ __('generator.legend.trackFilter') }}</legend>
      <div class="col-12 col-sm-8">
        <div class="row">
          <livewire:combo-generator.filters :filters="$trackFilters" type="track" />
        </div>
      </div>
    </fieldset>

    <hr />

    <div class="mb-3 row">
      <div class="col-12">
        <button type="submit" class="btn btn-primary">
          {{ __('generator.generate') }}
        </button>
      </div>
    </div>

    @if($combo)
    <div class="mb-3 row">
      <div class="col-12">
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">{{ __('generator.combo.heading') }}</h4>
          <p>
            <b>{{ $combo->car->name }}</b>
            <span>{{ __('generator.combo.on') }}</span>
            <b>{{ $combo->track->display_name }}</b>
          </p>
        </div>
      </div>
      @endif
  </form>
</div>
