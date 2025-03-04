import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [`resources/views/**/*`],
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        https: false,
        cors: true,
        hmr: {
            protocol: 'wss',
            clientPort: 443,
            host: 'vite-livewire.gametrack.ro' // Domeniul Cloudflare Tunnel
        }
    },
});
