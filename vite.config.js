import { defineConfig, loadEnv } from 'vite'; // <-- tambahkan loadEnv
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'; // optional, tergantung kamu pakai atau tidak

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd(), '');

    return {
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
        ],
        define: {
            'process.env': env,
        },
    };
});
