/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import Vue from 'vue';
import VueSwal from 'vue-swal';
import VueEditor from 'vue2-editor';
import axios from 'axios';
// home dashboard
import DashboardComponent from './components/DashboardComponent.vue';
// pages
import PagesComponent from './components/PagesComponent.vue';
// pages form
import PagesformComponent from './components/PagesformComponent.vue';
// files
import FilesComponent from './components/FilesComponent.vue';
// blogs
import BlogsComponent from './components/BlogsComponent.vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding  components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(axios)
Vue.use(VueSwal)
Vue.use(VueEditor)


var app = new Vue({
    el: '#app',
    components: {
        DashboardComponent,
        PagesComponent,
        PagesformComponent,
        FilesComponent,
        BlogsComponent,
    }
});

