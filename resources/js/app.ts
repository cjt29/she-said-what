import './bootstrap'
import '../css/app.css'

import '@fontsource-variable/figtree/wght-italic.css'

import { ZiggyVue } from 'ziggy-js'
import Toast from 'vue-toastification'
import { createInertiaApp } from '@inertiajs/vue3'
import { createApp, h, DefineComponent } from 'vue'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'

import { notifications } from '@/scripts/plugins/notifications'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
  title: title => `${title} - ${appName}`,
  resolve: name => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    // eslint-disable-next-line vue/component-api-style
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .use(notifications)
      .use(Toast)
      .mount(el)
  },
  progress: {
    color: '#4B5563',
  },
})

