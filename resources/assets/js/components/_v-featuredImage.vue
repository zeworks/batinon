<template>
    <div>
        <div class="c-card__body clearfix">
            <div class="f-subtitle u-margin-bottom-s">
                Featured Image
            </div>
            <b-row>
                <b-col sm="6">
                    <button type="button" class="c-btn c-btn--text c-btn--small" @click="fetchImages">Choose Image</button>
                </b-col>
                <b-col sm="6">
                    <button v-if="item.image" type="button" class="c-btn c-btn--danger c-btn--small float-right" @click="removeFeatured">Remove</button>
                </b-col>
            </b-row>
        </div>
        <div class="c-card__body">
            <div v-if="item.image">
                <img :src="item.image" alt class="u-img-responsive u-margin-bottom-s">
            </div>
            <div v-else>
                <img src="/placeholder.jpg" alt class="u-img-responsive u-margin-bottom-s">
            </div>
            <div>
                <p class="c-form__help">This image will appear on top of your page</p>
            </div>
        </div>
        <!-- modal library image -->
        <v-modal v-if="showModal">
            <div slot="header" class="f-subtitle">Choose your Featured Image</div>
            <div slot="body" class="clearfix">
                <div v-if="images==0" class="text-center">
                    <span>No files in storage yet!</span>
                </div>
                <b-row v-else>
                    <b-col sm="2" v-for="(image,index) in images" :key="index">
                        <button @click="chooseImage(origin+image_path+image.name)" :style="{ 'background-image': 'url(' + origin+image_path+image.name + ')' }"
                            type="button" class="c-btn btn--choose"></button>
                        <button type="button" @click="removeImage(image.id)" class="c-btn c-btn--rounded c-btn--danger">&times;</button>
                    </b-col>
                </b-row>
            </div>
            <div slot="footer">
                <div class="clearfix"></div>
                <div class="pull-right">
                    <input type="file" @change="onImageChange" id="file_input" name="file_input" class="hidden">
                    <button type="button" @click="showModal = false" class="c-btn c-btn--text">Cancel</button>
                    <button type="button" @click="fileClick" class="c-btn c-btn--primary">Or Send File...</button>
                </div>
            </div>
        </v-modal>
        <!-- \modal library image -->
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['item'],
        data() {
            return {
                origin: window.location.origin + '/',
                image_path: 'storage/images/',
                images: [],
                image: {},
            }
        },
        methods: {
            fetchImages() {
                this.showModal = true;
                this.isLoading();
                var req = axios.get('/api/files')
                    .then(response => response.data)
                    .then(data => {
                        this.images = data; // fill the array with all the images on database
                    });
                req.then(response => this.isLoading());
            },
            chooseImage(fileName) {
                this.showModal = false; // hide the modal
                this.item.image = fileName; // set the file choosed by the user
            },
            // if the user wants to upload a new file...
            fileClick() {
                $('#file_input').click();
            },
            // every time he changes the images...
            onImageChange(e) {
                this.image = document.querySelector('#file_input').files[0];
                this.uploadImage();
            },
            // save the image
            uploadImage() {

                const formData = new FormData();
                formData.append('image', this.image);

                axios.post('/api/files/add', formData)
                    .then(response => {
                        if (response.data.success) {
                            swal('Sucesso!', response.data.message, 'success');
                            // reload files
                            this.fetchImages();
                        } else {
                            swal('Erro!', response.data.message, 'error');
                        }
                    }).catch(function () {
                        swal('Erro!', response.data.message, 'error');
                    });
            },
            // remove image
            removeImage(id) {
                swal({
                        title: "Tem certeza?",
                        text: "Once deleted, you will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            axios.post('/api/files/delete', {
                                    data: id
                                })
                                .then(response => {
                                    // success alert
                                    swal('Sucesso!', response.data.message, 'success');
                                    this.fetchImages();
                                })
                        } else {
                            swal.close();
                        }
                    });
            },
            removeFeatured() {
                this.item.image = null;
            }
        }
    }
</script>

<style scoped>
    .btn--choose {
        width: 100%;
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