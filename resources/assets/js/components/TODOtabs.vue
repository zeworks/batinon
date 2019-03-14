<template>
    <div class="c-tab js-tab-system">
        <slot name="tabs" class="c-tab__tabs">
            <!-- tabs here -->
        </slot>
        <div class="c-tab__body">
            <slot name="content" class="c-tab__body-item" :class="{ 'is-active' : tabActive === 1 }">
                <!-- tab content here -->
            </slot>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tabActive: 1
            }
        }
    }
</script>

<style>

</style>