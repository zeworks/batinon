/**
 * In this file you only need to set the route and import which component to that route vue component.
 * Try always to use the names as camelCase, for best practices.
 */

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'is-active',
    routes: [{
        // home
            path: '/admin/home',
            component: require('@views/Home.vue')
        },
        { // pages
            path: '/admin/pages',
            component: require('@views/Pages.vue'),
            meta: {
                breadcrumb: [{
                    name: 'Pages',
                    link: '/admin/pages'
                }]
            }
        },
        {
            path: '/admin/pages/add',
            component: require('@views/PagesForm.vue')
        },
        {
            path: '/admin/pages/edit/:id',
            component: require('@views/PagesForm.vue')
        },
        { // blog
            path: '/admin/blog',
            component: require('@views/Blog.vue'),
        },
        {
            path: '/admin/blog/add',
            component: require('@views/BlogForm.vue')
        },
        {
            path: '/admin/blog/edit/:id',
            component: require('@views/BlogForm.vue')
        },
        { // banners
            path: '/admin/banners',
            component: require('@views/Banners.vue')
        },
        {
            path: '/admin/banners/add',
            component: require('@views/BannersForm.vue')
        },
        {
            path: '/admin/banners/edit/:id',
            component: require('@views/BannersForm.vue')
        },
        { // files
            path: '/admin/files',
            component: require('@views/Files.vue')
        },
        { // navigation
            path: '/admin/navigation',
            component: require('@views/Navigation.vue')
        },
        { // products
            path: '/admin/products',
            component: require('@views/Products.vue')
        },
        {
            path: '/admin/products/add',
            component: require('@views/ProductsForm.vue')
        },
        {
            path: '/admin/products/edit/:id',
            component: require('@views/ProductsForm.vue')
        },
        {
            path: '*',
            component: require('@views/404.vue')
        }
    ]
})

export default router;