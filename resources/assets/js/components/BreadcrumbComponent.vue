<template>
    <b-container fluid>
        <ul class="c-breadcrumb u-unlist" v-if="currentLink[2] != 'home'">
            <li class="c-breadcrumb__item">
                <a href="/admin/home" class="c-breadcrumb__link">home</a>
                <i class="fas fa-angle-right c-breadcrumb__icon u-icon-after"></i>
            </li>
            <li v-if="currentLink[2]" class="c-breadcrumb__item">
                 <a :href="'/admin/' + currentLink[2]" class="c-breadcrumb__link">{{ currentLink[2] }}</a>
                <i class="fas fa-angle-right c-breadcrumb__icon u-icon-after"></i>
            </li>
            <li v-if="currentLink[3]" class="c-breadcrumb__item">
                {{ currentLink[3] }}
            </li>
        </ul>
    </b-container>
</template>

<script>
    export default {
        data() {
            return {
                currentLink: null,
            }
        },
        created() {
            this.setCurrentLink()
        },
        methods: {
            setCurrentLink() {
                this.currentLink = new URL(location.href).pathname.split('/');
            }
        }
    }
</script>