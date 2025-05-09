<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])

  </head>
  <body>
    <h1 class="text-3xl font-bold underline text-red-500">
      Hello world!
    </h1>

    @livewire('chat.single-chat', ['chats' => $chats])

    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Regis</a>
  </body>
</html>