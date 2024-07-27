import { createApp } from 'vue'
// import './style.css'
import './index.css'
import store from './store'
import router from './router'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';
import App from './App.vue'
const vuetify = createVuetify({
    components,
    directives,
  })

createApp(App)
.use(store)
.use(vuetify)
.use(router)
.use(PrimeVue, {
  theme: {
      preset: Aura
  }
})
.mount('#app')
