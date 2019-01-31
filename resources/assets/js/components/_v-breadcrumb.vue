<template>
    <b-container fluid>
        <ul class="c-breadcrumb u-unlist">
            <li class="c-breadcrumb__item">
                <a href="/admin/home" class="c-breadcrumb__link">home</a>
                <i class="fas fa-angle-right c-breadcrumb__icon u-icon-after"></i>
            </li>
            <li v-if="currentLink[2]" class="c-breadcrumb__item">
                <router-link :style=" { display: 'inline-block' }" :to="'/admin/' + currentLink[2]" class="c-breadcrumb__link">{{ currentLink[2] }}</router-link>
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
        data (){
            return {
                breadcrumbList: []
            }
        }
    }
</script>