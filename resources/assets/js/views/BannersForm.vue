<template>
    <form @submit.prevent="saveData">
        <b-container fluid>
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
                        <v-featuredImage :item="banners" />
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
                        this.banners = data[0];
                    });

                req.then(response => this.isLoading());
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
                                swal('Sucesso!', 'Banner saved', 'success');
                                this.$router.push("/admin/banners");
                            } else {
                                swal('Erro!', 'Banner not saved', 'error');
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
                                swal('Sucesso!', 'Banner saved', 'success');
                                this.$router.push("/admin/banners");
                            } else {
                                swal('Erro!', 'Banner not saved', 'error');
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

<style>

</style>