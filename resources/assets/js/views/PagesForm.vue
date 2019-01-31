<template>
    <form @submit.prevent="saveData">
        <b-container fluid>
            <v-returnComponent />
            <b-row>
                <b-col sm="9">
                    <div class="c-card">
                        <div class="c-card__body">
                            <b-row>
                                <b-col sm="7">
                                    <div class="c-form">
                                        <label for="title" class="c-form__label">Page Name*</label>
                                        <input type="text" id="title" name="title" class="c-form__input" v-model="page.title">
                                    </div>
                                </b-col>
                                <b-col sm="5">
                                    <div class="c-form">
                                        <label for="slug" class="c-form__label">Page Slug</label>
                                        <input disabled type="text" id="slug" name="slug" class="c-form__input" :slug="slug"
                                            v-model="slug">
                                    </div>
                                </b-col>
                            </b-row>
                        </div>
                    </div>
                    <br>
                    <v-blocksComponent :item="page" :title="'Page Blocks'" />
                </b-col>
                <b-col sm="3">
                    <div class="c-card">
                        <v-statusComponent :item="page" />
                        <hr>
                        <v-featuredImage :item="page" />
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
        computed: {
            slug() {
                var slug = this.suglifyTitle(this.page.title);
                return slug;
            }
        },
        data() {
            return {
                page: [{
                    status: false,
                    name: '',
                    slug: '',
                    b_title: '',
                    b_summary: '',
                    b_description: '',
                    image: '',
                }],
            }
        },
        created() {
            if (this.$route.params.id) {
                this.fetchPages();
            }
        },
        methods: {
            fetchPages() {
                this.isLoading();                
                var req = axios.get('/api/pages/' + this.$route.params.id)
                    .then(response => response.data)
                    .then(data => {
                        if (data.success) {
                            this.page = data.content[0];
                        } else {
                            this.$router.replace(data.redirect);
                            swal('Erro!', data.message, 'error');
                        }
                    });
                req.then(response => this.isLoading());
            },
            saveData() {
                if (this.$route.params.id > 0) {
                    axios.post('/api/pages/edit/' + this.$route.params.id, {
                            id: this.$route.params.id,
                            title: this.page.title,
                            status: this.page.status,
                            slug: this.slug,
                            b_title: this.page.b_title,
                            b_summary: this.page.b_summary,
                            b_description: this.page.b_description,
                            b_image: this.page.b_image,
                            image: this.page.image,
                        })
                        .then(response => {
                            if (response.data.success) {
                                swal('Sucesso!', response.data.message, 'success');
                                this.$router.push("/admin/pages");
                            } else {
                                swal('Erro!', response.data.message, 'error');
                            }
                            
                        });
                } else {
                    axios.post('/api/pages/add', {
                            title: this.page.title,
                            status: this.page.status,
                            slug: this.slug,
                            b_title: this.page.b_title,
                            b_summary: this.page.b_summary,
                            b_description: this.page.b_description,
                            b_image: this.page.b_image,
                            image: this.page.image,
                        })
                        .then(response => {
                           if (response.data.success) {
                                swal('Sucesso!', response.data.message, 'success');
                                this.$router.push("/admin/pages");
                            } else {
                                swal('Erro!', response.data.message, 'error');
                            }
                        })
                        .catch(error => {
                            swal('Erro!', 'Por favor, preenche todos os campos obrigatórios.', 'error');
                        });
                }
            }
        }
    }
</script>
