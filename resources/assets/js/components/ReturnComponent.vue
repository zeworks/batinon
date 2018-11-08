<template>
    <div>
        <a :href="'/admin/' + currentLink[2]" class="c-btn c-btn--default u-margin-bottom-s"><i class="fas fa-chevron-left u-icon-before"></i>return</a>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                currentLink: null,
            }
        },
        created() {
            this.setCurrentLink()
        },
        methods: {
            setCurrentLink() {
                this.currentLink = new URL(location.href).pathname.split('/');
            }
        }
    }
</script>