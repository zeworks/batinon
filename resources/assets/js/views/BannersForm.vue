<template>
    <form @submit.prevent="saveData">
        <b-container fluid v-if="contentLoaded">
            <b-row>
                <b-col sm="9">
                    <div class="c-form">
                        <label for="title" class="c-form__label">Title*</label>
                        <input type="text" id="title" name="title" class="c-form__input" v-model="banners.title">
                    </div>
                    <div class="c-form">
                        <label for="summary" class="c-form__label">Summary</label>
                        <vueEditor id="summary" name="summary" v-model="banners.summary"></vueEditor>
                    </div>
                </b-col>
                <b-col sm="3">
                    <div class="c-card">
                        <v-statusComponent :item="banners" />
                        <hr>
                        <v-featuredImage @featuredImage="chooseImage" :item="banners.image" />
                        <v-submitComponent :id="$route.params.id" />
                    </div>
                </b-col>
            </b-row>
        </b-container>
    </form>
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                banners: [{
                    status: false,
                    title: '',
                    summary: '',
                    image: '',
                }],
                contentLoaded: false
            }
        },
        created() {
            if (this.$route.params.id) {
                this.fetch();
            }
        },
        methods: {
            fetch() {
                this.isLoading();
                var req = axios.get('/api/banners/' + this.$route.params.id)
                    .then(response => response.data)
                    .then(data => {
                        if (data.success) {
                            this.banners = data.content[0];
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
                    axios.post('/api/banners/edit/' + this.$route.params.id, {
                            id: this.$route.params.id,
                            title: this.banners.title,
                            status: this.banners.status,
                            summary: this.banners.summary,
                            image: this.banners.image,
                        })
                        .then(response => {
                            if (response.data.success) {
                                swal('Sucesso!', response.data.message, 'success');
                                this.$router.push("/admin/banners");
                            } else {
                                swal('Erro!', response.data.message, 'error');
                            }
                        });
                } else {
                    axios.post('/api/banners/add', {
                            title: this.banners.title,
                            status: this.banners.status,
                            summary: this.banners.summary,
                            image: this.banners.image,
                        })
                        .then(response => {
                            if (response.data.success) {
                                swal('Sucesso!', response.data.message, 'success');
                                this.$router.push("/admin/banners");
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
                this.banners.image = image;
            }
        }
    }
</script>

<style>

</style>