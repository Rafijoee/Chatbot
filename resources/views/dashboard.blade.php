<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Similique aliquid ratione magni obcaecati dolorem aperiam, perspiciatis architecto cumque ad corporis.</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-red-500">
            Logout
        </button>
    </form>
    <br>
    <br>
    @foreach ($users as  $user)
    <a href="{{ route('chat.single', ['id' => $user->id]) }}">Chat</a>
        
    @endforeach
</body>
</html>