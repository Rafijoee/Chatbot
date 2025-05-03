<div>
    <br>
    <ul>
        @foreach ($conversations as $item)
            <li>{{ $item['username'] }}: {{ $item['message'] }}</li>
        @endforeach
    </ul>
    
    <form wire:submit="submit">
        <input type="text" wire:model="message" name="" id="">
        <button type="submit" >Send</button>
    </form>
</div>
