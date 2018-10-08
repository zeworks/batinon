<template>
    <div>
        <form @submit.prevent="saveData" :id="id" class="row">
            <div class="col-sm-9">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <label for="title">Page Name*</label>
                                    <input type="text" id="title" name="title" class="form-control" v-model="page.title">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="slug">Page Slug</label>
                                    <input disabled type="text" id="slug" name="slug" class="form-control" :slug="slug" v-model="page.slug">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <blocksComponent :item="page" :title="'Page Blocks'"/>
            </div>
            <div class="col-sm-3">
                <div class="box box-default">
                    <statusComponent :item="page"/>
                    <hr>
                    <featuredImageComponent :item="page"/>
                    <submitComponent :id="id"/>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import blocksComponent from './BlocksComponent.vue';
    import submitComponent from './SubmitComponent.vue';
    import statusComponent from './StatusComponent.vue';
    import featuredImageComponent from './FeaturedImageComponent.vue';

    export default {
        props: ['id'],
        computed: {
            slug() {
                var slug = this.sanitizeTitle(this.page.title);
                return slug;
            }
        },
        components:{
            blocksComponent,
            submitComponent,
            statusComponent,
            featuredImageComponent
        },
        data() {
            return {
                page : [
                    {
                        status           : false,
                        name             : '', 
                        slug             : '',
                        b_title          : '',
                        b_summary    : '',
                        b_description : '',
                        image            : '',
                    }
                ],
            }
        },
        created(){
            if(this.id){
                this.fetchPages();
            }
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
                    axios.post('/api/pages/edit/'+this.id,{
                        id               : this.id,
                        title            : this.page.title,
                        status           : this.page.status,
                        slug             : this.page.slug,
                        b_title          : this.page.b_title,
                        b_summary        : this.page.b_summary,
                        b_description    : this.page.b_description,
                        b_image          : this.page.b_image,
                        image            : this.page.image,
                    })
                    .then(response => {
                        if(response.data.success)
                            swal('Sucesso!','Page saved','success');
                        else
                            swal('Erro!','Page not saved','error');
                    });
                }else{
                    axios.post('/api/pages/add',{
                        title            : this.page.title,
                        status           : this.page.status,
                        slug             : this.page.slug,
                        b_title          : this.page.b_title,
                        b_summary        : this.page.b_summary,
                        b_description    : this.page.b_description,
                        b_image          : this.page.b_image,
                        image            : this.page.image,
                    })
                    .then(response => {
                        if(response.data.success)
                            swal('Sucesso!','Page saved','success');
                        else
                            swal('Erro!','Page not saved','error');
                    })
                    .catch(error => {
                        swal('Erro!','Please fill all the required fields.','error');
                    });
                }
            },
            sanitizeTitle(title) {
                var slug = "";
                // Change to lower case
                if(title){
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
    }
</script>

