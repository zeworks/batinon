<template>
    <b-container fluid>
        <ul class="c-breadcrumb u-unlist">
            <li class="c-breadcrumb__item">
                <a href="/admin/home" class="c-breadcrumb__link">home</a>
                <i class="fas fa-angle-right c-breadcrumb__icon u-icon-after"></i>
            </li>
            <li v-if="this.$root.breadcrumbPath[2]" class="c-breadcrumb__item">
                <router-link :style=" { display: 'inline-block' }" :to="'/admin/' + this.$root.breadcrumbPath[2]" class="c-breadcrumb__link">{{ breadcrumbPath[2] }}</router-link>
                <i class="fas fa-angle-right c-breadcrumb__icon u-icon-after"></i>
            </li>
            <li v-if="breadcrumbPath[3]" class="c-breadcrumb__item">
                {{ breadcrumbPath[3] }}
            </li>
        </ul>
    </b-container>
</template>

<script>
    export default {
        data (){
            return {
            }
        }
    }
</script>