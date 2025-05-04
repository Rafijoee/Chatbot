import Echo from 'laravel-echo';

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY ?? 'local',
    wsHost: import.meta.env.VITE_REVERB_HOST ?? window.location.hostname,
    wsPort: parseInt(import.meta.env.VITE_REVERB_PORT) ?? 8080,
    wssPort: parseInt(import.meta.env.VITE_REVERB_PORT) ?? 8080,
    forceTLS: false,
    enabledTransports: ['ws', 'wss'],
});

console.log('✅ Echo initialized');
