/**
 * In this file you only need to set the route and import which component to that route vue component.
 * Try always to use the names as camelCase, for best practices.
 */

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    linkActiveClass: 'is-active',
    routes: [{
        path: '/admin/pages',
        component: require('./views/Pages.vue')
    },
    {
        path: '/admin/pages/add',
        component: require('./views/PagesForm.vue')
    },
    {
        path: '/admin/pages/edit/:id',
        component: require('./views/PagesForm.vue')
    }]
})