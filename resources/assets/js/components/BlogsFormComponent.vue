<template>
    <form @submit.prevent="saveData" :id="id">
        <b-container fluid>
            <returnComponent />
            <b-row>
                <b-col sm="9">
                    <blocksComponent :item="blog" />
                </b-col>
                <b-col sm="3">
                    <div class="c-card">
                        <statusComponent :item="blog" />
                        <hr>
                        <featuredImageComponent :item="blog" />
                        <submitComponent :id="id" />
                    </div>
                </b-col>
            </b-row>
        </b-container>
    </form>
</template>

<script>
    import axios from 'axios';
    import blocksComponent from './BlocksComponent.vue';
    import submitComponent from './SubmitComponent.vue';
    import statusComponent from './StatusComponent.vue';
    import featuredImageComponent from './FeaturedImageComponent.vue';
    import returnComponent from './ReturnComponent.vue';

    export default {
        props: ['id'],
        components: {
            blocksComponent,
            submitComponent,
            statusComponent,
            featuredImageComponent,
            returnComponent
        },
        data() {
            return {
                blog: [{
                    status: false,
                    slug: '',
                    b_title: '',
                    b_summary: '',
                    b_description: '',
                    b_image: '',
                    image: '',
                }],
            }
        },
        created() {
            if (this.id) {
                this.fetchBlogs();
            }
        },
        methods: {
            fetchBlogs() {

                var req = axios.get('/api/blogs/edit/' + this.id)
                    .then(response => response.data)
                    .then(data => {
                        this.blog = data[0];
                    });
            },
            saveData() {
                if (this.id > 0) {
                    axios.post('/api/blogs/edit/' + this.id, {
                            id: this.id,
                            status: this.blog.status,
                            slug: this.sanitizeTitle(this.blog.b_title),
                            b_title: this.blog.b_title,
                            b_summary: this.blog.b_summary,
                            b_description: this.blog.b_description,
                            b_image: this.blog.b_image,
                            image: this.blog.image,
                        })
                        .then(response => {
                            if (response.data.success)
                                swal('Sucesso!', 'Blog saved', 'success');
                            else
                                swal('Erro!', 'Blog not saved', 'error');
                        });
                } else {
                    axios.post('/api/blogs/add', {
                            status: this.blog.status,
                            slug: this.sanitizeTitle(this.blog.b_title),
                            b_title: this.blog.b_title,
                            b_summary: this.blog.b_summary,
                            b_description: this.blog.b_description,
                            b_image: this.blog.b_image,
                            image: this.blog.image,
                        })
                        .then(response => {
                            if (response.data.success)
                                swal('Sucesso!', 'Blog saved', 'success');
                            else
                                swal('Erro!', 'Blog not saved', 'error');
                        })
                        .catch(error => {
                            swal('Erro!', 'Please fill all the required fields.', 'error');
                        });
                }
            },
            sanitizeTitle(title) {
                var slug = "";
                // Change to lower case
                if (title) {
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

                    this.blog.slug = slug;

                    return (slug != '' ? slug : '')
                }
            }
        }
    }
</script>