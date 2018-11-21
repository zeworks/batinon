<template>
    <div>
        <div class="c-notification">
            {{ message }}
        </div>
    </div>
</template>

<script>
    export default {
        props: ['type', 'message'],
        data() {
            return {

            }
        },
        methods: {
            notify(){
                alert(22);
            }
        },
        created() {
            console.log('v-notification component mounted!');
            // alert(this.message)
        }
    }
</script>

<style>

</style>