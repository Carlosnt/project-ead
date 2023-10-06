import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    optimizeDeps: {
        include: [
            'ziggy'
        ]
    },
   
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',   
                //site
                'resources/css/site/app.css',             
                //admin
                'resources/css/admin/app.css',
                'resources/css/admin/resources.scss',
                //client
                'resources/css/client/app.css',
                
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
