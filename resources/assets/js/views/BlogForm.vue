<template>
    <form @submit.prevent="saveData" enctype="multipart/form-data">
        <b-container fluid>
            <!-- <returnComponent /> -->
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
                    <!-- <v-blocksComponent :item="blog" /> -->
                    <b-row>
                        <b-col sm="3" v-for="(image,index) in blogImages" :key="index">
                            <img class="u-img-responsive" v-if="image.file_name" :src="origin+image_path+image.file_name" alt="">
                        </b-col>
                    </b-row>
                    <v-slider :item="blogImages" :checked-images="checkedImages" />
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
                origin: window.location.origin + '/',
				image_path: 'storage/images/',
                blog: [{
                    status: false,
                    slug: '',
                    b_title: '',
                    b_summary: '',
                    b_description: '',
                    b_image: '',
                    image: '',
                }],
                blogImages: [],
                checkedImages: []
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
                        this.blogImages = data[0].files
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
                            multiple_images: this.checkedImages,
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
                            multiple_images: this.checkedImages,
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