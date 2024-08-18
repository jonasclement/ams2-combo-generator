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
  <div class="container">
    {{ $slot }}
  </div>
</body>

<!-- Scripts -->
@vite(['resources/js/app.js'])
@livewireScripts

</html>
