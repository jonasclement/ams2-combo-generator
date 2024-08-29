<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ $title ?? config('app.name') }}</title>

  <!-- CSS -->
  @vite(['resources/sass/app.scss'])
  @livewireStyles
</head>

<body>
  <div class="container pt-3">
    {{ $slot }}
    <div class="row mt-5">
      <div class="col-12">
        <p>Love AMS2? Join <a href="https://mvrc.racing/discord" target="_blank">the MVRC Discord</a> and race with us!</p>
      </div>
    </div>
  </div>
</body>

<!-- Scripts -->
@vite(['resources/js/app.js'])
@livewireScripts

</html>
