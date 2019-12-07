import Vue from 'vue'

import router from "./router";
import App from "./AppComponent";
import '../sass/app.scss'
window.require = './bootstrap'

const app = new Vue({
    router,
    render: h => h(App)
}).$mount('#app')
