<template>
    <div>
        <div class="box box-primary">
            <div class="box-header">
                <div class="box-title">Page Blocks</div>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="block_title">Block Title*</label>
                    <input type="text" id="block_title" name="block_title" class="form-control" v-model="page.b_title">
                </div>
                <div class="form-group">
                    <label for="block_summary">Block Summary</label>
                    <vueEditor id="block_summary" name="block_summary" v-model="page.b_summary"></vueEditor>
                </div>
                <div class="form-group">
                    <label for="block_description">Block Description</label>
                    <vueEditor id="block_description" name="block_description" v-model="page.b_description"></vueEditor>
                </div>
                <div class="form-group">
                    <label for="block_files">Block Image(s)</label>
                    <input type="file" name="block_files[]" id="block_files" multiple>
                    <p class="help-block">Choose wich images you want to display into this block</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['page'],
        data() {
            return {}
        }
    }
</script>