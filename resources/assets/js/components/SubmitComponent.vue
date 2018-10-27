<template>
    <div>
        <div class="c-card__footer clearfix">
            <div class="float-right">
                <a class="c-btn c-btn--link" href="/admin/pages">Cancel</a>
                <!-- edit button -->
                <button type="submit" v-if="id" class="c-btn c-btn--primary">Save</button>
                <!-- new button -->
                <button type="submit" v-else class="c-btn c-btn--primary">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {}
        }
    }
</script>