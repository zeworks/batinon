<template>
    <div>
        <nav class="c-nav">
            <div class="c-nav__user">
                <img :src="userImage" alt="user image">
                <span class="c-nav__user-name">
                    {{ username }}
                </span>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        props: ['username'],
        data(){
            return{
                userImage : '/user.png',
            }
        },
        created(){
        }
    }
</script>

<style scoped>
    img{
        max-width: 50px;
    }
</style>
