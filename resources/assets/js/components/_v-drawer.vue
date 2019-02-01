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
                    <li v-for="(item, index) in navItems" :key="index" class="c-nav__item">
                        <router-link v-if="item.active" :to="item.url" class="c-nav__link u-text-transform-none">
                            <i :class=" item.icon + ' c-nav__icon u-icon-before'"></i>
                            {{ item.title }}
                        </router-link>
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
                navItems: [
                    {
                        title: 'Home',
                        url: '/admin/home',
                        icon: 'fas fa-tachometer-alt',
                        active: true
                    },
                    {
                        title: 'Banners',
                        url: '/admin/banners',
                        icon: 'fas fa-file',
                        active: true
                    },
                    {
                        title: 'Blog',
                        url: '/admin/blog',
                        icon: 'fab fa-blogger-b',
                        active: true
                    },
                    {
                        title: 'Pages',
                        url: '/admin/pages',
                        icon: 'fas fa-file',
                        active: true
                    },
                    {
                        title: 'Products',
                        url: '/admin/products',
                        icon: 'fas fa-hand-holding-usd',
                        active: true
                    },
                    {
                        title: 'Files',
                        url: '/admin/files',
                        icon: 'fas fa-file-archive',
                        active: true
                    },
                    {
                        title: 'Navigation',
                        url: '/admin/navigation',
                        icon: 'fas fa-bars',
                        active: true
                    }
                ]
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
