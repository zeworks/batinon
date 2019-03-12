<template>
    <header class="c-header">
        <b-container fluid>
            <b-row>
                <b-col sm="6">
                    <button class="c-header__lineHeight float-left" @click="toggleDrawer" id="btn-menu"><i class="fas fa-bars u-color-white"></i></button>
                    <h4 class="float-left u-font-medium u-font-size-large u-color-white c-header__lineHeight">
                        Batinon v1</h4>
                </b-col>
                <b-col sm="6" class="clearfix">
                    <div class="c-profile c-profile--header float-right">
                        <!-- profile -->
                        <button class="c-profile__btn" @click="openProfileCard">
                            <img class="c-profile__img" :src="[ this.$root.userImageBase64 ? this.$root.userImageBase64 : this.$root.userImage ]" alt="profile image">
                            <i class="fas fa-ellipsis-v c-profile__btn-icon u-color-white"></i>
                        </button>
                        <!-- profile card -->
                        <div class="c-profile__card" :class="{ 'c-profile__card-active' : isActive}">
                            <div class="c-profile__item c-profile__item--disabled">
                                <strong class="c-profile__item-title">{{this.$root.userName}}</strong>
                                <small class="c-profile__item-subtitle">{{this.$root.userEmail}}</small>
                            </div>
                            <div class="c-profile__item">
                                <router-link to="/admin/profile" class="c-profile__item-link">Profile</router-link>
                            </div>
                            <div class="c-profile__item">
                                <router-link to="/admin/settings" class="c-profile__item-link">Settings</router-link>
                            </div>
                            <div class="c-profile__item">
                                <form :action="logout" method="POST">
                                    <input type="hidden" name="_token" :value="this.$root.access_token">
                                    <button class="c-btn c-btn--link c-btn--padding-0 c-btn--lineheight-0">logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="float-right"> -->
                        <!-- tasks -->
                        <!-- <button class="c-header__item c-header__lineHeight"><i class="fas fa-flag u-color-dark"></i></button> -->
                        <!-- notification -->
                        <!-- <button class="c-header__item c-header__lineHeight"><i class="fas fa-bell u-color-dark"></i></button> -->
                    <!-- </div> -->
                </b-col>
            </b-row>
        </b-container>
    </header>
</template>

<script>
    import axios from 'axios'

    export default {
        props: ['logout'],
        data() {
            return {
                isActive: false,
            }
        },
        mounted(){
            this.$root.getUserProfile()
        },
        methods: {
            openProfileCard() {
                this.isActive = !this.isActive;
            }
        },
    }
</script>

<style scoped>
    .userLogo {
        max-width: 25px;
        margin-right: 5px;
    }
</style>