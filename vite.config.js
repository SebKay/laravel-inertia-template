import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
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

    resolve: {
        alias: {
            'ziggy-js': '/vendor/tightenco/ziggy',
            '@': '/resources',
            '@fonts': '/public/fonts',
            '@img': '/public/img',
            '@js': '/resources/js',
            '@css': '/resources/css',
            '@scss': '/resources/scss',
        },
    },

    css: {
        preprocessorOptions: {
            scss: {
                api: 'modern',
            },
        },
    },

    build: {
        sourcemap: false,
        rollupOptions: {
            output: {
                manualChunks: (id) => {
                    if (id.includes('node_modules')) {
                        return 'vendor';
                    }

                    if (id.includes('resources/js')) {
                        return 'app';
                    }
                },
            },
        },
    },
});
