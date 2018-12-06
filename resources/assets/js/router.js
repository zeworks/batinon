import Vue from 'vue'
import VueRouter from 'vue-router'

import Pages from './views/Pages.vue'
Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    linkActiveClass: 'is-active',
    routes: [{
        path: '/admin/pages',
        name: 'pages',
        component: Pages
    }]
})