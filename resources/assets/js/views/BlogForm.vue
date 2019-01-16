<template>
    <form @submit.prevent="saveData">
        <b-container fluid>
            <!-- <returnComponent /> -->
            <b-row>
                <b-col sm="9">
                    <div class="c-form">
                        <label for="slug" class="c-form__label">Blog Slug</label>
                        <input disabled type="text" id="slug" name="slug" class="c-form__input" :slug="slug" v-model="slug">
                    </div>
                    <v-blocksComponent :item="blog" />
                </b-col>
                <b-col sm="3">
                    <div class="c-card">
                        <v-statusComponent :item="blog" />
                        <hr>
                        <v-featuredImage :item="blog" />
                        <v-submitComponent :id="$route.params.id" />
                    </div>
                </b-col>
            </b-row>
        </b-container>
    </form>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['id'],
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
            if (this.$route.params.id) {
                this.fetchBlogs();
            }
        },
        computed: {
            slug() {
                var slug = this.suglifyTitle(this.blog.b_title);
                return slug;
            }
        },
        methods: {
            fetchBlogs() {

                axios.get('/api/blogs/edit/' + this.$route.params.id)
                    .then(response => response.data)
                    .then(data => {
                        this.blog = data[0];
                    });
            },
            saveData() {
                if (this.$route.params.id > 0) {
                    axios.post('/api/blogs/edit/' + this.$route.params.id, {
                            id: this.$route.params.id,
                            status: this.blog.status,
                            slug: this.suglifyTitle(this.blog.b_title),
                            b_title: this.blog.b_title,
                            b_summary: this.blog.b_summary,
                            b_description: this.blog.b_description,
                            b_image: this.blog.b_image,
                            image: this.blog.image,
                        })
                        .then(response => {
                            if (response.data.success) {
                                swal('Sucesso!', 'Blog saved', 'success');
                                this.$router.push("/admin/blog");
                            } else {
                                swal('Erro!', 'Blog not saved', 'error');
                            }
                        });
                } else {
                    axios.post('/api/blogs/add', {
                            status: this.blog.status,
                            slug: this.suglifyTitle(this.blog.b_title),
                            b_title: this.blog.b_title,
                            b_summary: this.blog.b_summary,
                            b_description: this.blog.b_description,
                            b_image: this.blog.b_image,
                            image: this.blog.image,
                        })
                        .then(response => {
                            if (response.data.success) {
                                swal('Sucesso!', 'Blog saved', 'success');
                                this.$router.push("/admin/blog");
                            } else {
                                swal('Erro!', 'Blog not saved', 'error');
                            }
                        })
                        .catch(error => {
                            swal('Erro!', 'Please fill all the required fields.', 'error');
                        });
                }
            }
        }
    }
</script>