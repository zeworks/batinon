/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import Vue from 'vue';

// bootstrap 4
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import VueSwal from 'vue-swal';
import VueEditor from 'vue2-editor';

// nav component
import NavComponent from './components/NavComponent.vue';
// header component
import HeaderComponent from './components/HeaderComponent.vue';
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
// blog form
import BlogsformComponent from './components/BlogsFormComponent.vue';
// navigation
import NavigationComponent from './components/NavigationComponent.vue';


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding  components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueSwal)
Vue.use(VueEditor)
Vue.use(BootstrapVue);

Vue.mixin({
  created: function () {
    var myOption = this.$options.myOption
    if (myOption) {
      return (
        `<div class="u-loading">
              <div class="u-loading__items">
                <div></div>
                <div></div>
              </div>
          </div>`
      )
    }
  }
})


var app = new Vue({
    el: '#app',
    components: {
        NavComponent,
        HeaderComponent,
        DashboardComponent,
        PagesComponent,
        PagesformComponent,
        FilesComponent,
        BlogsComponent,
        BlogsformComponent,
        NavigationComponent,
    },
});
