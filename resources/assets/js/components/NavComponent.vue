<template>
    <aside>
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
        <form action="" method="GET" class="clearfix">
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
                    <a href="/admin/pages" :class="activeMenu('pages')" class="c-nav__link u-text-transform-none"><i class="fas fa-file c-nav__icon u-icon-before"></i>Pages</a>
                </li>
                <li class="c-nav__item">
                    <a href="/admin/blog" :class="activeMenu('blog')" class="c-nav__link u-text-transform-none"><i class="fab fa-blogger-b c-nav__icon u-icon-before"></i>Blog</a>
                </li>
                <li class="c-nav__item">
                    <a href="/admin/files" :class="activeMenu('files')" class="c-nav__link u-text-transform-none"><i class="fas fa-file-archive c-nav__icon u-icon-before"></i>Files</a>
                </li>
                <li class="c-nav__item">
                    <a href="/admin/navigation" :class="activeMenu('navigation')" class="c-nav__link u-text-transform-none"><i class="fas fa-bars c-nav__icon u-icon-before"></i>Navigation</a>
                </li>
            </ul>
        </nav>
    </aside>
</template>

<script>
    export default {
        props: ['username', 'useremail'],
        data() {
            return {
                userImage: '/logo.png',
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
