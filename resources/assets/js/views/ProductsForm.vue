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
                                        <label for="title" class="c-form__label" >Product Name*</label>
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
                            </b-row>
                        </div>
                    </div>
                    <br>
                    <v-blocksComponent :item="product" :title="'Product Blocks'" />
                    <v-slider @updateSlider="updateSlider" :item="productImages" />
                </b-col>
                <b-col sm="3">
                    <div class="c-card">
                        <v-statusComponent :item="product" />
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
    export default {
        computed: {
            slug() {
                var slug = this.suglifyTitle(this.product.name);
                return slug;
            }
        },
        data() {
            return {
                product: [{
                    status: false,
                    name: '',
                    slug: '',
                }],
                productImages: new Array()
            }
        },
        methods: {
            updateSlider(array){
                this.productImages = array;
            },
            save(){
                console.log('saving...');
            }
        }
    }
</script>

<style>

</style>