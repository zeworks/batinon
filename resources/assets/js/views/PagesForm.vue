<template>
    <form @submit.prevent="saveData">
        <b-container fluid v-if="contentLoaded">
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
                        <div class="c-card__body">
                            <b-row>
                                <b-col sm="6">
                                    <div class="c-form">
                                        <label for="order" class="c-form__label">Page Order</label>
                                        <input type="text" id="order" class="c-form__input" v-model.number="page.order">
                                    </div>
                                </b-col>
                                <b-col sm="6">
                                    <div class="c-form">
                                        <label for="position" class="c-form__label">Menu Position</label>
                                        <select class="c-form__select" v-model.number="page.position">
                                            <option v-for="(nav,index) in navigation" :value="nav.id" :key="index">{{nav.title}}</option>
                                        </select>
                                    </div>
                                </b-col>
                            </b-row>
                        </div>
                        <hr>
                        <v-featuredImage @featuredImage="chooseImage" :item="page.image" />
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
                page: {
                    status: false,
                    name: '',
                    slug: '',
                    b_title: '',
                    b_summary: '',
                    b_description: '',
                    image: '',
                    order: 0,
                    position: 0,
                },
                contentLoaded: false,
                navigation: [],
            }
        },
        mounted() {
            if (this.$route.params.id) {
                this.fetchPages();
            } else {
                this.contentLoaded = true
            }
            this.getNavigations();
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
                req.then(response => this.contentLoaded = true);
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
                            order: this.page.order,
                            position: this.page.position,
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
                            order: this.page.order,
                            position: this.page.position,
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
            },
            chooseImage(image) {
                this.page.image = image;
            },
            getNavigations() {
                axios.get('/api/navigation')
                    .then(response => response.data)
                    .then(data => {
                        this.navigation = data.navigations;
                    });
            }
        }
    }
</script>