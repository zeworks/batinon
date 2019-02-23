<template>
    <b-container fluid>
        <form @submit.prevent="save">
            <b-row v-if="settings.length">
                <b-col sm="6" offset-md="1" md="3">
                    <h2 class="u-font-bold">Settings</h2>
                </b-col>
                <b-col sm="6" offset-md="1" md="6">
                    <br>
                    <br>
                    <div class="c-card">
                        <div class="c-card__body">
                            <div class="u-font-size-medium u-color-grey-light u-font-medium u-text-transform-uppercase">
                                Informações do Website
                            </div>
                            <hr>
                            <b-row>
                                <!-- website name -->
                                <b-col sm="6">
                                    <div class="c-form">
                                        <label for="website_name" class="c-form__label">Nome do Website</label>
                                        <input type="text" id="website_name" class="c-form__input" v-model="settings[0].website_name">
                                    </div>
                                </b-col>
                                <!-- legal website name -->
                                <b-col sm="6">
                                    <div class="c-form">
                                        <label for="website_legal_name" class="c-form__label">Nome legal do Website</label>
                                        <input type="text" id="website_legal_name" class="c-form__input" v-model="settings[0].website_legal_name">
                                    </div>
                                </b-col>
                                <!-- email account website -->
                                <b-col sm="12">
                                    <div class="c-form">
                                        <label for="website_account_email" class="c-form__label">Conta de Email do Website</label>
                                        <input type="text" id="website_account_email" class="c-form__input" v-model="settings[0].website_account_email">
                                    </div>
                                </b-col>
                                <!-- website description -->
                                <b-col sm="12">
                                    <div class="c-form">
                                        <label for="website_desc" class="c-form__label">Descrição do Website</label>
                                        <span class="c-form__info"> <i class="fas fa-info c-form__info--icon"></i> A
                                            descrição do seu website serve para na pesquisa google, ser visível aos seus
                                            subscritores!</span>
                                        <input type="text" id="website_desc" class="c-form__input" v-model="settings[0].website_desc">
                                    </div>
                                </b-col>
                            </b-row>
                            <br>
                            <div class="u-font-size-medium u-color-grey-light u-font-medium u-text-transform-uppercase">
                                Informações Pessoais
                            </div>
                            <span class="c-form__info"> <i class="fas fa-info c-form__info--icon"></i>Nenhuma destas
                                informções serão visíveis, apenas para sí!</span>
                            <hr>
                            <b-row>
                                <b-col sm="4">
                                    <div class="c-form">
                                        <label for="website_phone" class="c-form__label">Telemóvel</label>
                                        <input type="text" id="website_phone" class="c-form__input" v-model="settings[0].website_phone">
                                    </div>
                                </b-col>
                                <b-col sm="4">
                                    <div class="c-form">
                                        <label for="website_country" class="c-form__label">País</label>
                                        <input type="text" id="website_country" class="c-form__input" v-model="settings[0].website_country">
                                    </div>
                                </b-col>
                                <b-col sm="4">
                                    <div class="c-form">
                                        <label for="website_postal_code" class="c-form__label">Código Postal</label>
                                        <input type="text" id="website_postal_code" class="c-form__input" v-model="settings[0].website_postal_code">
                                    </div>
                                </b-col>
                                <b-col sm="6">
                                    <div class="c-form">
                                        <label for="website_city" class="c-form__label">Cidade</label>
                                        <input type="text" id="website_city" class="c-form__input" v-model="settings[0].website_city">
                                    </div>
                                </b-col>
                                <b-col sm="6">
                                    <div class="c-form">
                                        <label for="website_region" class="c-form__label">Região</label>
                                        <input type="text" id="website_region" class="c-form__input" v-model="settings[0].website_region">
                                    </div>
                                </b-col>
                                <b-col sm="12">
                                    <div class="c-form">
                                        <label for="website_street" class="c-form__label">Rua</label>
                                        <input type="text" id="website_street" class="c-form__input" v-model="settings[0].website_street">
                                    </div>
                                </b-col>
                            </b-row>
                            <!-- END NORMAL DETAILS -->

                            <template v-if="settings[0].website_mode_store">
                            <!-- STORE DETAILS -->
                            <br>
                            <div class="u-font-size-medium u-color-grey-light u-font-medium u-text-transform-uppercase">
                                Informações da Loja
                            </div>
                            <span class="c-form__info"> <i class="fas fa-info c-form__info--icon"></i>Nenhuma destas
                                informções serão visíveis</span>
                            <hr>
                            <b-row>
                                <b-col sm="6">
                                    <div class="c-form">
                                        <label for="website_iban" class="c-form__label">IBAN</label>
                                        <input type="text" id="website_iban" class="c-form__input" v-model="settings[0].website_iban">
                                    </div>
                                </b-col>
                                <b-col sm="6">
                                    <div class="c-form">
                                        <label for="website_currency" class="c-form__label">Currency</label>
                                        <input type="text" id="website_currency" class="c-form__input" v-model="settings[0].website_currency">
                                    </div>
                                </b-col>
                                <b-col sm="6">
                                    <div class="c-form">
                                        <label for="website_order_prefix" class="c-form__label">Prefixo de Encomeda</label>
                                        <span class="c-form__info"> <i class="fas fa-info c-form__info--icon"></i>Ex: #A2...</span>
                                        <input type="text" id="website_order_prefix" class="c-form__input" v-model="settings[0].website_order_prefix">
                                    </div>
                                </b-col>
                                <b-col sm="6">
                                    <div class="c-form">
                                        <label for="website_order_suffix" class="c-form__label">Sufixo de Encomeda</label>
                                        <span class="c-form__info"> <i class="fas fa-info c-form__info--icon"></i>Ex: ...#A2</span>
                                        <input type="text" id="website_order_suffix" class="c-form__input" v-model="settings[0].website_order_suffix">
                                    </div>
                                </b-col>
                            </b-row>
                            <!-- END STORE DETAILS -->
                            </template>

                            <!-- SOCIAL NETWORK -->
                            <br>
                            <div class="u-font-size-medium u-color-grey-light u-font-medium u-text-transform-uppercase">
                                Redes Sociais
                            </div>
                            <hr>
                            <b-row>
                                <b-col sm="12">
                                    <div class="c-form">
                                        <label for="website_url_facebook" class="c-form__label">Url de Facbook</label>
                                        <input type="text" id="website_url_facebook" class="c-form__input" placeholder="https://my-url.com" v-model="settings[0].website_url_facebook">
                                    </div>
                                </b-col>
                                <b-col sm="12">
                                    <div class="c-form">
                                        <label for="website_url_twitter" class="c-form__label">Url de Twitter</label>
                                        <input type="text" id="website_url_twitter" class="c-form__input" placeholder="https://my-url.com" v-model="settings[0].website_url_twitter">
                                    </div>
                                </b-col>
                                <b-col sm="12">
                                    <div class="c-form">
                                        <label for="website_url_instagram" class="c-form__label">Url de Instagram</label>
                                        <input type="text" id="website_url_instagram" class="c-form__input" placeholder="https://my-url.com" v-model="settings[0].website_url_instagram">
                                    </div>
                                </b-col>
                                <b-col sm="12">
                                    <div class="c-form">
                                        <label for="website_url_google" class="c-form__label">Url de Google+</label>
                                        <input type="text" id="website_url_google" class="c-form__input" placeholder="https://my-url.com" v-model="settings[0].website_url_google">
                                    </div>
                                </b-col>
                            </b-row>
                            <!-- END NETWORK -->
                            <button @click="save" class="c-btn c-btn--primary float-right">Save</button>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                </b-col>
            </b-row>
        </form>
    </b-container>
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                settings: {}
            }
        },
        mounted() {
            this.getSettings();
        },
        methods: {
            getSettings() {
                this.isLoading();

                var req = axios.get('/api/settings')
                    .then(response => response.data)
                    .then(data => {
                        this.settings = data;
                    })

                req.then(response => {
                    this.isLoading()
                })
            },
            save(){
                axios.put('/api/settings', {
                    data: this.settings
                })
                .then(response => response.data)
                .then(data => {
                    if (data.success) {
                        swal('Sucesso!', data.message, 'success');
                    }
                })
            }
        }
    }
</script>

<style>

</style>