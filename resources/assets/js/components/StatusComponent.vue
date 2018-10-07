<template>
    <div>
        <div class="box-header">
            <div class="box-title">
                Status
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="status" v-model="item.status"
                        true-value="1" false-value="0">
                    <span class="custom-control-indicator"></span>
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