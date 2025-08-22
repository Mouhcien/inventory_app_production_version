import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/bootstrap.css',
                'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),

    ],
    
    server: {
    host: '10.93.128.64', // Allow access from all IP addresses
        port: 3000,       // You can adjust the port if needed
        https: false,
        cors: {
            origin: '*',       // Allow requests from any origin (use a specific origin if needed for production)
            methods: ['GET', 'POST', 'PUT', 'DELETE'],  // Allow specific HTTP methods
            allowedHeaders: ['Content-Type', 'Authorization'], // Adjust according to your headers
        },
    },
    
});
