<template>
    <header class="c-header">
        <button class="c-btn c-btn--text js-toggle-aside" id="btn-menu"><i class="fas fa-bars"></i></button>

        <div class="c-profile c-profile--header float-right">
            <button class="c-profile__btn">
                <img :src="userImage" alt="profile image">
                <i class="fas fa-angle-down c-profile__btn-caret"></i>
            </button>
            <!-- <span class="c-profile__name">
                {{ username }}
            </span>
            <span class="c-profile__email">
                email@email.pt
            </span> -->
        </div>
        <!-- logout form -->
        <form id="logout-form" :action="logout" method="POST" class="float-right">
            <input type="hidden" name="_token" :value="csrf">
            <button class="c-btn c-btn--primary">logout</button>
        </form>
        <!-- logout form ends -->
    </header>
</template>

<script>
    export default {
        props: ['logout'],
        data() {
            return {
                userImage: '/user.png',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods: {}
    }
</script>

<style scoped>
    #logout-form {
        line-height: 60px;
    }

    #btn-menu {
        margin: 12px 10px 0;
    }

    img {
        max-width: 40px;
    }
    
</style>

