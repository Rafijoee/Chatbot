<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>{{ $title ?? 'Chatbot' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    @livewireStyles
  </head>
  <body class="bg-gray-100 min-h-screen">
    {{ $slot }}

    @livewireScripts
</body>
</html>