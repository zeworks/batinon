<template>
    <form @submit.prevent="save">
        <b-container fluid>
            <b-row>
                <b-col sm="9">
                    <div class="c-card">
                        <div class="c-card__body">
                            <b-row>
                                <b-col sm="7">
                                    <div class="c-form">
                                        <label for="title" class="c-form__label">Product Name*</label>
                                        <input type="text" id="title" name="title" class="c-form__input" v-model="product.name">
                                    </div>
                                </b-col>
                                <b-col sm="5">
                                    <div class="c-form">
                                        <label for="slug" class="c-form__label">Product Slug</label>
                                        <input disabled type="text" id="slug" name="slug" class="c-form__input" :slug="slug"
                                            v-model="slug">
                                    </div>
                                </b-col>
                                <b-col sm="12" md="6">
                                    <div class="c-form">
                                        <br>
                                        <label for="description" class="c-form__label">Description</label>
                                        <vueEditor id="description" name="description" v-model="product.description"></vueEditor>
                                    </div>
                                </b-col>
                                <b-col sm="12" md="6">
                                    <div class="c-form">
                                        <br>
                                        <label for="details" class="c-form__label">Details</label>
                                        <vueEditor id="details" name="details" v-model="product.details"></vueEditor>
                                    </div>
                                </b-col>
                                <!-- store mode -->
                                <b-col sm="12">
                                    <hr>
                                    <b-row>
                                        <b-col sm="4">
                                            <div class="c-form">
                                                <label for="reference" class="c-form__label">Product Reference</label>
                                                <input type="text" id="reference" name="reference" class="c-form__input"
                                                    v-model="product.reference">
                                            </div>
                                        </b-col>
                                        <b-col sm="4">
                                            <div class="c-form">
                                                <label for="product_weight" class="c-form__label">Product Weight</label>
                                                <input type="text" id="product_weight" name="product_weight" class="c-form__input"
                                                    v-model="product.product_weight">
                                            </div>
                                        </b-col>
                                        <b-col sm="4">
                                            <div class="c-form">
                                                <label for="product_size" class="c-form__label">Product Reference</label>
                                                <input type="text" id="product_size" name="product_size" class="c-form__input"
                                                    v-model="product.product_size">
                                            </div>
                                        </b-col>
                                        <b-col sm="12">
                                            <span class="c-form__label u-margin-bottom-s">Product Colors</span>
                                            <chrome-picker v-model="colors" />
                                        </b-col>
                                    </b-row>
                                </b-col>
                            </b-row>
                        </div>
                    </div>
                    <br>
                    <v-slider @updateSlider="updateSlider" :item="productImages" />
                </b-col>
                <b-col sm="3">
                    <div class="c-card">
                        <b-row>
                            <b-col md="6">
                                <v-statusComponent :item="product" />
                            </b-col>
                            <b-col md="6">
                                <div class="c-card__body">
                                    <div class="form-group" :style="{'position':'relative'}">
                                        <label class="c-form__checkbox">
                                            <input type="checkbox" class="c-form__input" v-model="product.highlight"
                                                name="highlight" id="highlight">
                                            <span class="c-form__checkbox-indicator"></span>
                                            Destaque
                                        </label>
                                    </div>
                                </div>
                            </b-col>
                        </b-row>
                        <hr>
                        <v-featuredImage :item="product" />
                        <v-submitComponent :id="$route.params.id" />
                    </div>
                </b-col>
            </b-row>
        </b-container>
    </form>
</template>

<script>
    import {
        Chrome
    } from 'vue-color'
    export default {
        components: {
            'chrome-picker': Chrome
        },
        computed: {
            slug() {
                var slug = this.suglifyTitle(this.product.name);
                return slug;
            }
        },
        data() {
            return {
                product: {},
                productImages: new Array(),
                colors: {
                    hex: '#194d33',
                    hsl: {
                        h: 150,
                        s: 0.5,
                        l: 0.2,
                        a: 1
                    },
                    hsv: {
                        h: 150,
                        s: 0.66,
                        v: 0.30,
                        a: 1
                    },
                    rgba: {
                        r: 25,
                        g: 77,
                        b: 51,
                        a: 1
                    },
                    a: 1
                }
            }
        },
        methods: {
            updateSlider(array) {
                this.productImages = array;
            },
            save() {
                console.log('saving...');
            }
        }
    }
</script>

<style>

</style>