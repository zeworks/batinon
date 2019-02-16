<template>
    <form @submit.prevent="saveData" enctype="multipart/form-data">
        <b-container fluid v-if="contentLoaded">
            <b-row>
                <b-col sm="9">
                    <div class="c-form">
                        <label for="slug" class="c-form__label">Blog Slug</label>
                        <input disabled type="text" id="slug" name="slug" class="c-form__input" :slug="slug" v-model="slug">
                    </div>
                    <div class="c-form">
                        <label class="c-form__label" for="block_title">Title*</label>
                        <input type="text" id="block_title" name="block_title" class="c-form__input" v-model="blog.b_title">
                    </div>
                    <div class="c-form">
                        <label for="block_summary" class="c-form__label">Summary</label>
                        <vueEditor id="block_summary" name="block_summary" v-model="blog.b_summary"></vueEditor>
                    </div>
                    <div class="c-form">
                        <br>
                        <label for="block_description" class="c-form__label">Description</label>
                        <vueEditor id="block_description" name="block_description" v-model="blog.b_description"></vueEditor>
                    </div>
                    <v-slider @updateSlider="updateSlider" :item="blogImages" />
                </b-col>
                <b-col sm="3">
                    <div class="c-card">
                        <v-statusComponent :item="blog" />
                        <hr>
                        <v-featuredImage @featuredImage="chooseImage" :item="blog.image" />
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
                    image: '',
                }],
                blogImages: [],
                contentLoaded: false,
            }
        },
        mounted() {
            if (this.$route.params.id) {
                this.fetchBlogs();
            } else {
                this.contentLoaded = true
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
                this.isLoading();  
                var req = axios.get('/api/blogs/' + this.$route.params.id)
                    .then(response => response.data)
                    .then(data => {
                        if (data.success) {
                            var array = data.content[0].files;

                            this.blog = data.content[0];
                            array.forEach(element => {
                                this.blogImages.push(element.file_name);
                            });
                        } else {
                            this.$router.replace(data.redirect);
                            swal('Erro!', data.message, 'error');
                        }
                    });
                req.then(response => this.isLoading());
                req.then(response => this.contentLoaded = true);

            },
            updateSlider(array){
                this.blogImages = array;
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
                            multiple_images: this.blogImages,
                            image: this.blog.image,
                        })
                        .then(response => {
                            if (response.data.success) {
                                swal('Sucesso!', response.data.message, 'success');
                                this.$router.push("/admin/blog");
                            } else {
                                swal('Erro!', response.data.message, 'error');
                            }
                        });
                } else {
                    axios.post('/api/blogs/add', {
                            status: this.blog.status,
                            slug: this.suglifyTitle(this.blog.b_title),
                            b_title: this.blog.b_title,
                            b_summary: this.blog.b_summary,
                            b_description: this.blog.b_description,
                            multiple_images: this.blogImages,
                            image: this.blog.image,
                        })
                        .then(response => {
                            if (response.data.success) {
                                swal('Sucesso!', response.data.message, 'success');
                                this.$router.push("/admin/blog");
                            } else {
                                swal('Erro!', response.data.message, 'error');
                            }
                        })
                        .catch(error => {
                            swal('Erro!', 'Por favor, preenche todos os campos obrigatórios.', 'error');
                        });
                }
            },
            chooseImage(image) {
                this.blog.image = image;
            }
        }
    }
</script>