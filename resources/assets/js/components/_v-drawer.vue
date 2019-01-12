<template>
    <aside class="c-aside" @click="toggleDrawer" :class="{ 'is-active' : this.$root.drawerActive }">
        <div class="c-aside__content">
            <div class="c-profile">
                <img :src="userImage" alt="profile image">
                <span class="c-profile__name">
                    {{ username }}
                </span>
                <span class="c-profile__email">
                    {{ useremail }}
                </span>
            </div>
            <hr>
            <form @click.prevent="toggleDrawer" action="" method="GET" class="clearfix">
                <div class="c-form c-form--search c-form--group c-form--group-right float-right">
                    <button class="c-btn c-btn--text c-form__btn"><i class="fas fa-search"></i></button>
                    <input type="input" placeholder="Search" name="q" class="c-form__input c-form__input-icon">
                </div>
            </form>
            <nav class="c-nav">
                <ul class="u-margin-0 u-padding-0 u-unlist">
                    <li class="c-nav__item">
                        <a href="/admin/home" :class="activeMenu('home')" class="c-nav__link u-text-transform-none"><i class="fas fa-tachometer-alt c-nav__icon u-icon-before"></i>Dashboard</a>
                    </li>
                    <li class="c-nav__item">
                        <router-link to="/admin/banners" class="c-nav__link u-text-transform-none"><i class="fas fa-file c-nav__icon u-icon-before"></i>Banners</router-link>
                    </li>
                    <li class="c-nav__item">
                        <router-link to="/admin/blog" class="c-nav__link u-text-transform-none"><i class="fab fa-blogger-b c-nav__icon u-icon-before"></i>Blog</router-link>
                    </li>
                    <li class="c-nav__item">
                        <router-link to="/admin/pages" class="c-nav__link u-text-transform-none"><i class="fas fa-file c-nav__icon u-icon-before"></i>Pages</router-link>
                    </li>
                    <li class="c-nav__item">
                        <router-link to="/admin/files" class="c-nav__link u-text-transform-none"><i class="fas fa-file-archive c-nav__icon u-icon-before"></i>Files</router-link>
                    </li>
                    <li class="c-nav__item">
                        <router-link to="/admin/navigation" class="c-nav__link u-text-transform-none"><i class="fas fa-bars c-nav__icon u-icon-before"></i>Navigation</router-link>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script>
    export default {
        props: ['username', 'useremail'],
        data() {
            return {
                userImage: '/logo.jpg',
                currentLink: location.href,
            }
        },
        computed: {
            routes() {
                return window.routes
            },
        },
        created() {
            this.setCurrentLink()
        },
        methods: {
            route(url) {
                return this.routes.route(url)
            },
            activeMenu(segment) {
                return segment == this.currentLink ? 'is-active' : ''
            },
            setCurrentLink() {
                this.currentLink = new URL(location.href).pathname.split('/')[2];
            }
        }
    }
</script>

<style scoped>
    img {
        max-width: 50px;
        border-radius: 100%;
    }
</style>
