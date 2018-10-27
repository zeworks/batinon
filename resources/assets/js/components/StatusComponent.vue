<template>
    <div>
        <div class="c-card__body">
            <div class="f-subtitle">
                Status
            </div>
            <div class="c-form">
                <label class="c-form__checkbox">
                    <input type="checkbox" class="c-form__input" name="status" v-model="item.status"
                        true-value="1" false-value="0">
                    <span class="c-form__checkbox-indicator"></span>
                </label>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['item'],
        data(){
            return {}
        }
    }
</script>