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
                <li class="c-nav__item" :class="activeMenu('home')">
                    <a href="/admin/home" class="c-nav__link u-icon-before"><i class="fas fa-tachometer-alt c-nav__icon"></i>Dashboard</a>
                </li>
                <li class="c-nav__item" :class="activeMenu('pages')">
                    <a href="/admin/pages" class="c-nav__link u-icon-before"><i class="fas fa-file c-nav__icon"></i>Pages</a>
                </li>
                <li class="c-nav__item" :class="activeMenu('blog')">
                    <a href="/admin/blog" class="c-nav__link u-icon-before"><i class="fab fa-blogger-b c-nav__icon"></i>Blog</a>
                </li>
                <li class="c-nav__item" :class="activeMenu('files')">
                    <a href="/admin/files" class="c-nav__link u-icon-before"><i class="fas fa-file-archive c-nav__icon"></i>Files</a>
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
                userImage: '/user.png',
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
                return segment == this.currentLink ? 'c-nav__item-active' : ''
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
    }
</style>
