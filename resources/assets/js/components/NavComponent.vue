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
        </nav>
    </aside>
</template>

<script>
    export default {
        props: ['username'],
        data() {
            return {
                userImage: '/user.png',
            }
        },
        created() {}
    }
</script>

<style scoped>
    img {
        max-width: 50px;
    }
</style>