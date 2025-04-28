<div class="max-w-md mx-auto mt-10 p-6 bg-white shadow rounded">
    <form wire:submit.prevent="register">
        @csrf
        <div class="mb-4">
            <input wire:model="name" type="text" class="w-full p-2 border rounded" placeholder="Nama" required>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <input wire:model="email" type="email" class="w-full p-2 border rounded" placeholder="Email" required>
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 relative">
            @if ($showPassword)
            <input 
            wire:model="password" 
            type='password'
            class="w-full p-2 border rounded" 
            placeholder="Password" 
            required
            >   
            @else
            <input 
            wire:model="password" 
            type='text'
            class="w-full p-2 border rounded" 
            placeholder="Password" 
            required
            > 
            @endif
            <button type="button" wire:click="$toggle('showPassword')" class="absolute right-2 top-2 text-sm">
                {{ $showPassword ? 'Hide' : 'Show' }}
            </button>
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <input wire:model="password_confirmation" type="password" class="w-full p-2 border rounded" placeholder="Konfirmasi Password" required>
        </div>

        <button type="submit" class="w-full bg-green-500 text-white p-2 rounded">Register</button>
    </form>
</div>
