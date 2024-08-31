import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  plugins: [
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
