import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'
import { ZiggyVue } from 'ziggy-js'
// import { Ziggy } from './ziggy'
import '../css/app.css'

createInertiaApp({

  // resolve: async name => {
  //   const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
  //   // return pages[`./Pages/${name}.vue`]  

  //   const page = await pages[`./Pages/${name}.vue`] 
  //   page.default.layout = page.default.layout || MainLayout

  //   return page

  // },
    resolve: name => {
      const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })

      const page = pages[`./Pages/${name}.vue`]

      if (!page) {
          throw new Error(`Page not found: ${name}`)
      }

      page.default.layout = page.default.layout || MainLayout

      return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue) //, Ziggy
      .mount(el) 
  },

  progress: {
      color: '#29d',
  },

})