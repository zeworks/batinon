<template>
    <div>
        <form @submit.prevent="saveData" :id="id" class="row">
            <div class="col-sm-9">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <label for="title">Page Name</label>
                                    <input type="text" id="title" name="title" class="form-control" v-model="page.name">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="slug">Page Slug</label>
                                    <input type="text" id="slug" name="slug" class="form-control" disabled v-model="page.slug">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title">Page Blocks</div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="block_title">Block Title</label>
                            <input type="text" id="block_title" name="block_title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="block_summary">Block Summary</label>
                            <vueEditor id="block_summary" v-model="block_summary"></vueEditor>
                        </div>
                        <div class="form-group">
                            <label for="block_description">Block Description</label>
                            <vueEditor id="block_description" v-model="block_description"></vueEditor>
                        </div>
                        <div class="form-group">
                            <label for="block_files">Block Image(s)</label>
                            <input type="file" name="block_files[]" id="block_files" multiple>
                            <p class="help-block">Choose wich images you want to display into this block</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title">
                            Status
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" v-model="page.status">
                                <span class="custom-control-indicator"></span>
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="box-header">
                        <div class="box-title">
                            Featured Image
                        </div>
                    </div>
                    <div class="box-body">
                        <input type="file" name="image" id="image">
                        <p class="help-block">This image will appear on top of your page</p>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <a class="btn btn-default" href="/admin/pages">Cancel</a>
                            <!-- edit button -->
                            <button type="submit" v-if="id" class="btn btn-primary">Save</button>
                            <!-- new button -->
                            <button type="submit" v-else class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

    export default {
        props: ['id'],
        computed: {
            slug() {
                var slug = this.sanitizeTitle(this.page.name);
                return slug;
            }
        },
        data() {
            return {
                data              : [],
                page              : [],
                block_summary     : '',
                block_description : '',
            }
        },
        created(){
            this.fetchPages();
        },
        methods: {
            fetchPages(){
                axios.get('/api/pages/edit/'+this.id)
                .then(response => response.data)
                .then( data => {
                    this.page = data[0];
                });
            },
            saveData(){
                
                if(this.id > 0){
                    console.log('editar');
                    
                }else{
                    console.log('criar');
                    // axios.post('/api/pages/add',{data : this.data})
                    // .then(response => response.data)
                    // .then( data => {
                    // });
                }
            },
            sanitizeTitle(title) {
                var slug = "";
                // Change to lower case
                var titleLower = title.toLowerCase();
                // Letter "e"
                slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
                // Letter "a"
                slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
                // Letter "o"
                slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
                // Letter "u"
                slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
                // Letter "d"
                slug = slug.replace(/đ/gi, 'd');
                // Trim the last whitespace
                slug = slug.replace(/\s*$/g, '');
                // Change whitespace to "-"
                slug = slug.replace(/\s+/g, '-');
                
                this.page.slug = slug;
                
                return (slug != '' ? slug : '')
            }
        }
    }
</script>

