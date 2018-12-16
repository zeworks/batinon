/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import Vue from 'vue'
import './components/_globals'
import VueSwal from 'vue-swal'
import VueEditor from 'vue2-editor'
import BootstrapVue from 'bootstrap-vue'
import router from './router'

import 'vue-multiselect/dist/vue-multiselect.min.css'

// nav component
import NavComponent from './components/NavComponent.vue'

// header component
import HeaderComponent from './components/HeaderComponent.vue'

// breadcrumb component
import BreadcrumbComponent from './components/BreadcrumbComponent.vue'

// return component
import ReturnComponent from './components/BreadcrumbComponent.vue'

// home dashboard
import DashboardComponent from './components/DashboardComponent.vue'

// files
import FilesComponent from './components/FilesComponent.vue'

// blogs
import BlogsComponent from './components/BlogsComponent.vue'


// navigation
import NavigationComponent from './components/NavigationComponent.vue'

Vue.use(VueSwal)
Vue.use(VueEditor)
Vue.use(BootstrapVue)

Vue.mixin({
    data() {
        return {
            showModal: false,
            showModalLibrary: false,
            showModalPreview: false,
        }
    },
    methods: {
        suglifyTitle(title) {
            var slug = "";
            // Change to lower case
            if (title) {
                var titleLower = title.toLowerCase();
                // Letter "e"
                slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
                // Letter "a"
                slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
                // Letter "o"
                slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
                // Letter "u"
                slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
                // Letter "d"
                slug = slug.replace(/đ/gi, 'd');
                // Trim the last whitespace
                slug = slug.replace(/\s*$/g, '');
                // Change whitespace to "-"
                slug = slug.replace(/\s+/g, '-');

                this.page.slug = slug;

                return (slug != '' ? slug : '')
            }
        }
    }
})



var app = new Vue({
    el: '#app',
    router,
    components: {
        NavComponent,
        HeaderComponent,
        BreadcrumbComponent,
        ReturnComponent,
        DashboardComponent,
        // PagesformComponent,
        FilesComponent,
        BlogsComponent,
        // BlogsformComponent,
        NavigationComponent
    }
});