<template>
    <!-- submit component -->
    <div class="c-card__footer clearfix">
        <div class="float-right">
            <button type="button" class="c-btn c-btn--link" @click="goBack">Cancel</button>
            <button type="submit" class="c-btn c-btn--primary">Save</button>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            goBack() {
                window.location.href = '/admin/' + this.currentLink[2];
            }
        },
    }
</script>