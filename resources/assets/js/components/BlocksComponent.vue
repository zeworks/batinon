<template>
    <div>
        <div class="c-card">
            <div class="c-card__header">
                <span class="f-subtitle">{{title}}</span>
            </div>
            <div class="c-card__body">
                <div class="c-form">
                    <label class="c-form__label" for="block_title">Title*</label>
                    <input type="text" id="block_title" name="block_title" class="c-form__input" v-model="item.b_title">
                </div>
                <div class="c-form">
                    <br>
                    <label for="block_summary" class="c-form__label">Summary</label>
                    <vueEditor id="block_summary" name="block_summary" v-model="item.b_summary"></vueEditor>
                </div>
                <div class="c-form">
                    <br>
                    <label for="block_description" class="c-form__label">Description</label>
                    <vueEditor id="block_description" name="block_description" v-model="item.b_description"></vueEditor>
                </div>
                <div class="c-form">
                    <br>
                    <label class="c-form__label">Image</label>
                    <p class="c-form__help">Choose wich image you want to display into this block</p>
                    <b-row>
                        <b-col sm="4" v-if="item.b_image">
                            <img :src="item.b_image" alt class="u-img-responsive">
                            <br>
                        </b-col>
                    </b-row>
                    <button type="button" class="c-btn c-btn--primary" @click="fetchBlockImages">Choose Image</button>
                </div>
            </div>
        </div>
        <!-- modal choose block image -->
        <modal v-if="showModalBlockImages">
            <h3 slot="header">Choose your Block Image</h3>
            <div slot="body">
                <b-row>
                    <b-col sm="3" v-for="(image,index) in images" :key="index">
                        <button @click="chooseImage(origin+image_path+image.name)" :style="{ 'background-image': 'url(' + origin+image_path+image.name + ')' }"
                            type="button" class="c-btn btn--choose"></button>
                        <button type="button" @click="removeBlockImage(image.id)" class="c-btn c-btn--rounded c-btn--danger">&times;</button>
                    </b-col>
                </b-row>
            </div>
            <div slot="footer">
                <div class="clearfix"></div>
                <div class="float-right">
                    <input type="file" @change="onBlockImageChange" id="file_blockImages" name="file_blockImages" class="hidden">
                    <button type="button" @click="showModalBlockImages = false" class="c-btn c-btn--text">Cancel</button>
                    <button type="button" @click="fileClick" class="c-btn c-btn--primary">Or Send File...</button>
                </div>
            </div>
        </modal>
        <!-- :modal choose block image -->
    </div>
</template>

<script>
    import axios from 'axios';
    import modal from './ModalComponent.vue';

    export default {
        props: ['item', 'title'],
        components: {
            modal
        },
        data() {
            return {
                showModalBlockImages: false,
                origin: window.location.origin + '/',
                image_path: 'storage/images/',
                images: [],
                image: {},
            }
        },
        methods: {
            fetchBlockImages() {
                this.showModalBlockImages = true;

                axios.get('/api/files')
                    .then(response => response.data)
                    .then(data => {
                        this.images = data; // fill the array with all the images on database
                    });
            },
            chooseImage(fileName) {
                this.showModalBlockImages = false; // hide the modal
                this.item.b_image = fileName; // set the file choosed by the user
            },
            // if the user wants to upload a new file...
            fileClick() {
                $('#file_blockImages').click();
            },
            // every time he changes the images...
            onBlockImageChange(e) {
                this.image = document.querySelector('#file_blockImages').files[0];
                this.uploadBlockImages();
            },
            // save the image
            uploadBlockImages() {

                const formData = new FormData();
                formData.append('image', this.image);

                axios.post('/api/files/add', formData)
                    .then(response => {
                        if (response.data.success) {
                            swal('Success!', 'File saved', 'success');
                            // reload files
                            this.fetchBlockImages();
                        } else {
                            swal('Error!', 'File not saved, file too large [2MB Max]', 'error');
                        }
                    }).catch(function () {
                        swal('Error!', 'File not sent', 'error');
                    });
            },
            // remove image
            removeBlockImage(id) {
                axios.post('/api/files/delete', {
                        data: id
                    })
                    .then(response => {
                        // success alert
                        swal('Success!', 'File Deleted', 'success');
                        this.fetchBlockImages();
                    })
            }
        }
    }
</script>
<style scoped>
    .btn--choose {
        width: 210px;
        height: 210px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .c-btn--rounded {
        font-size: 28px;
        position: absolute;
        top: 10px;
        right: 30px;
        z-index: 1;
    }
</style>