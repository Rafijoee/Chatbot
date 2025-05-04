console.log("DEBUG ENV", import.meta.env.VITE_REVERB_APP_KEY); // ✅ HARUS tampil

import './bootstrap'; // <- HARUS di atas sebelum Livewire


import Echo from 'laravel-echo';

window.Echo = new Echo({
    broadcaster: 'reverb',
    host: window.location.hostname + ':6001',
});
