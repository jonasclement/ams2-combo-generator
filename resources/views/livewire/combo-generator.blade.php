<div>
  <form action="wire:generate">
    <fieldset class="mb-3 row">
      <legend class="col-12 col-sm-4 col-form-legend">{{ __('generator.legend.trackFilter') }}</legend>
      <div class="col-12 col-sm-8">
        <div class="row">
          <livewire:combo-generator.filters :filters="$trackFilters" type="track" />
        </div>
      </div>
    </fieldset>

    <hr />

    <fieldset class="mb-3 row">
      <legend class="col-12 col-sm-4 col-form-legend">{{ __('generator.legend.carFilter') }}</legend>
      <div class="col-12 col-sm-8">
        <div class="row">
          <livewire:combo-generator.filters :filters="$carFilters" type="car" />
        </div>
      </div>
    </fieldset>

    <div class="mb-3 row">
      <div class="col-12">
        <button type="submit" class="btn btn-primary">
          Action
        </button>
      </div>
    </div>
  </form>
</div>
