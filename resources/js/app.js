import { ZiggyVue } from 'ziggy-vue';
import route from 'ziggy';

import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

createInertiaApp({
    resolve: async name => {
        let page = resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'));

        return page;
    },

    setup({ el, App, props, plugin }) {
        const VueApp = createApp({ render: () => h(App, props) });

        VueApp
            .use(plugin)
            .use(ZiggyVue);

        VueApp
            .component('Head', Head)
            .component('Link', Link);

        VueApp
            .mount(el);
    },

    title: title => title ? `${title} | Template` : 'Template',
});

InertiaProgress.init({
    color: '#f5f5f5',
});
