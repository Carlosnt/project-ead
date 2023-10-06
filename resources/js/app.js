import '@fortawesome/fontawesome-free/css/all.min.css';
import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import  Toast, { POSITION }  from 'vue-toastification';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const OptionsToast = {
    position: POSITION.TOP_RIGHT,
    timeout: 5000,
    maxToasts: 3,
    toastClassName: 'shadow-lg rounded-lg ring-1 ring-back ring-opacity-5 font-sans bg-white',
    bodyClassName: ['custom-class-1','custom-class-2'],
    containerClassName: 'my-container-class',
    icon: false,
};

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(Toast, OptionsToast)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
