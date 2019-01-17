<template>
    <div>
        <div class="c-card__footer clearfix">
            <div class="float-right">
                <button type="button" class="c-btn c-btn--link" @click="goBack">Cancel</button>
                <button type="submit" class="c-btn c-btn--primary">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            goBack(){
                 window.history.go(-1);
            }
        },
    }
</script>