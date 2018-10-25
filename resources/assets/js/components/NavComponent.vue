<template>
    <aside>
        <div class="c-profile">
            <img :src="userImage" alt="profile image">
            <span class="c-profile__name">
                {{ username }}
            </span>
            <span class="c-profile__email">
                email@email.pt
            </span>
        </div>
        <hr>
        <nav class="c-nav">
            <ul class="u-margin-0 u-padding-0 u-unlist">
                <li class="c-nav__item" :class="activeMenu('home')">
                    <a href="/admin/home" class="c-nav__link u-icon-before"><i class="fas fa-tachometer-alt c-nav__icon"></i>Dashboard</a>
                </li>
                <li class="c-nav__item" :class="activeMenu('pages')">
                    <a href="/admin/pages" class="c-nav__link u-icon-before"><i class="fas fa-file c-nav__icon"></i>Pages</a>
                </li>
                <li class="c-nav__item"  :class="activeMenu('blog')">
                    <a href="/admin/blog" class="c-nav__link u-icon-before"><i class="fab fa-blogger-b c-nav__icon"></i>Blog</a>
                </li>
            </ul>
        </nav>
    </aside>
</template>

<script>
    export default {
        props: ['username'],
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