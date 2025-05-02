<div>
    <br>
    @dd($chats)
    @foreach ($chats as $chat )
        <p>{{ $chat }}</p>
    @endforeach
    <form wire:submit="submit">
        <input type="text" wire:model="message" name="" id="">
        <button type="submit" >Send</button>
    </form>
</div>
