import Vue from 'vue'

import vuetify from './plugins/vuetify'
import router from "./router";
import App from "./App";
import '../sass/app.scss'
window.require = 'bootstrap'

const app = new Vue({
    vuetify,
    router,
    render: h => h(App),
    el: '#app'
})
