<template>
    <header class="c-header">
        <b-container fluid>
            <b-row>
                <b-col sm="6">
                    <img class="c-header__logo" :src="logo" alt>
                    <button class="c-btn c-btn--text js-toggle-aside" id="btn-menu"><i class="fas fa-bars"></i></button>
                </b-col>
                <b-col sm="6">
                    <div class="c-profile c-profile--header float-right">
                        <!-- tasks -->
                        <button class="c-btn c-btn--text"><i class="fas fa-flag"></i></button>
                        <!-- notification -->
                        <button class="c-btn c-btn--text"><i class="fas fa-bell"></i></button>
                        <!-- profile -->
                        <button class="c-profile__btn" @click="openProfileCard">
                            <img class="c-profile__img" :src="userImage" alt="profile image">
                            <i class="fas fa-ellipsis-v c-profile__btn-icon"></i>
                        </button>
                        <!-- profile card -->
                        <div class="c-profile__card" :class="{ 'c-profile__card-active' : isActive}">
                            <div class="c-profile__item c-profile__item--disabled">
                                <strong class="c-profile__item-title">{{username}}</strong>
                                <small class="c-profile__item-subtitle">{{useremail}}</small>
                            </div>
                            <div class="c-profile__item">
                                <a href="" class="c-profile__item-link">Profile</a>
                            </div>
                            <div class="c-profile__item">
                                <a href="" class="c-profile__item-link">Settings</a>
                            </div>
                            <div class="c-profile__item">
                                <form :action="logout" method="POST">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <button class="c-btn c-btn--link c-btn--padding-0 c-btn--lineheight-0">logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </b-col>
            </b-row>
        </b-container>


    </header>
</template>

<script>
    export default {
        props: ['logout', 'username', 'useremail'],
        data() {
            return {
                isActive: false,
                userImage: '/user.png',
                logo: '/logo.png',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods: {
            openProfileCard() {
                this.isActive = !this.isActive;
            }
        }
    }
</script>

<style scoped>

</style>