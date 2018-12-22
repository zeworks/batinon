<template>
    <header class="c-header">
        <b-container fluid>
            <b-row>
                <b-col sm="6">
                    <button class="c-header__lineHeight float-left" @click="toggleDrawer" id="btn-menu"><i
                            class="fas fa-bars u-color-dark"></i></button>
                    <h4 class="float-left u-font-medium u-font-size-large c-header__lineHeight">
                        Batinon</h4>
                </b-col>
                <b-col sm="6" class="clearfix">
                    <div class="c-profile c-profile--header float-right">
                        <!-- profile -->
                        <button class="c-profile__btn" @click="openProfileCard">
                            <img class="c-profile__img" :src="userImage" alt="profile image">
                            <i class="fas fa-ellipsis-v c-profile__btn-icon u-color-dark"></i>
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
                    <div class="float-right">
                        <!-- tasks -->
                        <button class="c-header__item c-header__lineHeight"><i class="fas fa-flag u-color-dark"></i></button>
                        <!-- notification -->
                        <button class="c-header__item c-header__lineHeight"><i class="fas fa-bell u-color-dark"></i></button>
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
                userLogo: '/logo.png',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
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