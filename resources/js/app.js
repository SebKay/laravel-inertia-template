import { ZiggyVue } from 'ziggy-vue';
import route from 'ziggy';

import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head } from '@inertiajs/vue3';

import { userCan } from "@js/utilities/permissions.js";

import Notice from "@js/Components/Notice.vue";
import Button from "@js/Components/Button.vue";

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });

        return pages[`./Pages/${name}.vue`];
    },

    setup({ el, App, props, plugin }) {
        const Vue = createApp({ render: () => h(App, props) });

        Vue.use(plugin)
            .use(ZiggyVue);

        Vue.mixin({ methods: { userCan } });

        Vue.component('Head', Head)
            .component('Link', Link)
            .component('Notice', Notice)
            .component('Button', Button);

        Vue.mount(el);
    },

    title: title => title ? `${title} | Template` : 'Template',

    progress: {
        color: '#f5f5f5',
    },
});
