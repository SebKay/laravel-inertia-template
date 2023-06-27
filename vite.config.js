import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import svgLoader from 'vite-svg-loader';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
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

        svgLoader({
            svgoConfig: {
                multipass: true,
            },
        }),
    ],

    resolve: {
        alias: {
            'ziggy': '/vendor/tightenco/ziggy/src/js',
            'ziggy-vue': '/vendor/tightenco/ziggy/src/js/vue',
            '@': '/resources',
            '@fonts': '/public/fonts',
            '@img': '/public/img',
            '@scss': '/resources/scss',
            '@js': '/resources/js',
        },
    },

    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `
                    @use "@scss/utilities/_variables.scss" as *;
                    @use "@scss/utilities/_functions.scss" as *;
                    @use "@scss/utilities/_mixins.scss" as *;
                    @use "@scss/utilities/_placeholders.scss" as *;
                `
            },
        },
    },

    build: {
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        return 'vendor';
                    }

                    if (id.includes('resources')) {
                        return 'app';
                    }
                },
            },
        },
    },
});
