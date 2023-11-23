import { ZiggyVue } from 'ziggy-vue';
import route from 'ziggy';

import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head } from '@inertiajs/vue3';

import { userCan } from "@js/utilities/permissions.js";

import { Bars3Icon, XMarkIcon, SparklesIcon, CheckCircleIcon, XCircleIcon } from '@heroicons/vue/24/outline';

import AppLayout from "@js/Layouts/App.vue";

import Notice from "@js/Components/Notice.vue";
import Button from "@js/Components/Button.vue";

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        let page = pages[`./Pages/${name}.vue`];

        page.default.layout = page.default.layout || AppLayout;

        return page;
    },

    setup({ el, App, props, plugin }) {
        const Vue = createApp({ render: () => h(App, props) });

        Vue.use(plugin)
            .use(ZiggyVue);

        Vue.mixin({ methods: { userCan } });

        Vue.component('Bars3Icon', Bars3Icon)
            .component('XMarkIcon', XMarkIcon)
            .component('SparklesIcon', SparklesIcon)
            .component('CheckCircleIcon', CheckCircleIcon)
            .component('XCircleIcon', XCircleIcon);

        Vue.component('Head', Head)
            .component('Link', Link)
            .component('Notice', Notice)
            .component('Button', Button);

        Vue.mount(el);
    },

    title: title => title ? `${title} | Template` : 'Template',

    progress: {
        color: '#000',
    },
});
