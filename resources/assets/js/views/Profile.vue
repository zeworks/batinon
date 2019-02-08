<template>
    <div>
        profile
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        mounted() {
            axios.get('/api/user')
                .then(response => response.data)
                .then(data => {
                    console.log(data);
                })
        }
    }
</script>