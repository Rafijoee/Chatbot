<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="user-id" content="{{ auth()->id() }}">
    <title>{{ $title ?? 'Chatbot' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles
  </head>
  <body class="bg-gray-100 min-h-screen">
    <p>rtes
    </p>
    {{ $slot }}

    @livewireScripts
</body>
</html>