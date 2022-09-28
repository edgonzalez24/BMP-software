import './bootstrap';
import '../css/app.css';
import '../scss/main.scss';
import "vue-toastification/dist/index.css";
import "vue-select/dist/vue-select.css";
import '@vueup/vue-quill/dist/vue-quill.snow.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Toast from "vue-toastification";
import vSelect from "vue-select";
import { useToast } from "vue-toastification";
import { QuillEditor } from '@vueup/vue-quill'

// FontAwesome
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
library.add(fas, fab)

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
const toast = useToast();
createInertiaApp({
	title: (title) => `${title} - ${appName}`,
	resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
	setup({ el, app, props, plugin }) {
		const myApp = createApp({ render: () => h(app, props) })
		myApp.config.globalProperties.$toast = toast;
			myApp.use(plugin)
			.use(Toast)
			.use(ZiggyVue, Ziggy)
			.mixin({ methods: { route } })
			.component("v-select", vSelect)
			.component('FontAwesomeIcon', FontAwesomeIcon)
			.component('QuillEditor', QuillEditor)
			.mount(el);
		return myApp;
	},
});

InertiaProgress.init({ color: '#4B5563' });
