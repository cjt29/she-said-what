import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'
import autoimport from 'unplugin-auto-import/vite'
import components from 'unplugin-vue-components/vite'

export default defineConfig({
  plugins: [
    autoimport({
      vueTemplate: true,
      dts: 'resources/js/scripts/types/auto-imports.d.ts',
      imports: [
        'vue',
        { '@inertiajs/vue3': ['router', 'useForm', 'usePage'] },
      ],
      dirs: ['resources/js/scripts/composables'],
    }),
    components({
      dts: 'resources/js/scripts/types/components.d.ts',
      resolvers: [
        (name: string) => {
          const components = ['Link', 'Head']

          if (components.includes(name)) {
            return {
              name,
              from: '@inertiajs/vue3',
            }
          }
        },
      ],
      dirs: ['resources/js/components/global'],
    }),
    laravel({
      input: 'resources/js/app.ts',
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
      '@': '/resources/js',
      '~': '/node_modules',
    },
  },
  server: {
    host: true,
    strictPort: true,
    port: 5173,
    hmr: {
      protocol: 'wss',
      host: process.env.DDEV_HOSTNAME,
    },
  },
})
