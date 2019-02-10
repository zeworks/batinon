/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import Vue from 'vue'
import '@components/_globals'
import VueSwal from 'vue-swal'
import VueEditor from 'vue2-editor'
import BootstrapVue from 'bootstrap-vue'
import router from './router'

import 'vue-multiselect/dist/vue-multiselect.min.css'

// home dashboard
import DashboardComponent from '@components/DashboardComponent.vue'

Vue.use(VueSwal)
Vue.use(VueEditor)
Vue.use(BootstrapVue)

Vue.directive('focus', {
    // When the bound element is inserted into the DOM...
    inserted: function (el) {
      // Focus the element
      el.focus()
    }
})

Vue.mixin({
    data() {
        return {
            origin: window.location.origin + '/',
            image_path: 'storage/images/',
            drawerActive: false,
            loading: false,
            placeholders: false,
            showModal: false,
            showModalLibrary: false,
            showModalPreview: false,
            breadcrumbPath: '',
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

                return (slug != '' ? slug : '')
            }
        },
        toggleDrawer() {
            this.$root.drawerActive = !this.$root.drawerActive;
        },
        isLoading() {
            this.$root.loading = !this.$root.loading;
        },
        isHolding() {
            this.$root.placeholders = !this.$root.placeholders;
        }
    },
    computed: {
        currentLink() {
            return new URL(location.href).pathname.split('/');
        }
    },
    watch: {
        $route(to) {
            this.breadcrumbPath = to.path.split('/');
        }
    },
    mounted() {
        this.breadcrumbPath = window.location.pathname.split('/');
    }
})

var app = new Vue({
    el: '#app',
    router,
    components: {
        DashboardComponent
    }
});