<template>
    <div>
        <div :id="id" class="row">
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
                                    <input type="text" id="slug" name="slug" class="form-control" disabled v-if="page.slug" v-model="slug">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                Status
                                <input type="checkbox" class="custom-control-input" v-model="page.status">
                                <span class="custom-control-indicator"></span>
                            </label>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="button" class="btn btn-default" @click="back">Cancel</button>
                            <button type="button" class="btn btn-primary" @click="saveData">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue';

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
                page : [],
            }
        },
        created(){
            this.fetchPages();
        },
        methods: {
            back(){
                window.history.back();
            },
            fetchPages(){
                axios.get('/api/pages/edit/'+this.id)
                .then(response => response.data)
                .then( data => {
                    this.page = data[0];
                });
            },
            saveData(){
                console.log(this.page);
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

