import {createApp} from 'vue'
import App from '@/App.vue'
import router from '@/router'
import store from "@/store";
import MediumEditor from 'vuejs-medium-editor'
import '@/assets/styles/main.scss'

const app = createApp(App)

app.use(router)
    .use(store)
    .component('medium-editor', MediumEditor)
    .mount('#app')
