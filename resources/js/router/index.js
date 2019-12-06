import Vue from 'vue'
import VueRouter from "vue-router"
import LayoutComponent from "../components/layout/LayoutComponent";
import Store from "../views/Store";

Vue.use(VueRouter)

const routes = [
    {
        path: '/store',
        component: LayoutComponent,
        children: [
            {
                path: ':storeId',
                name: 'store',
                component: Store
            }

        ]
    },
    {
        path: '*',
        redirect: '/store/1'
    }
]

export default new VueRouter({
    mode: 'history',
    routes
})
