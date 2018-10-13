<template>
    <div>
        <div class="box-header clearfix">
            <div class="box-title pull-left">
                Featured Image
            </div>
            <button type="button" class="btn btn-primary pull-right" @click="fetchImages">Choose Image</button>
        </div>
        <div class="box-body">
            <div v-if="item.image">
                <img :src="item.image" alt class="u-img-responsive">
            </div>
            <br>
            <div>
                <p class="help-block">This image will appear on top of your page</p>
            </div>
        </div>
        <!-- modal library image -->
        <modal :modal="showModalFeatured" v-if="showModalFeatured">
            <h3 slot="header">Choose your Featured Image</h3>
            <div slot="body" class="clearfix">
                <div v-for="(image,index) in images" :key="index" class="modal-image clearfix">
                    <button @click="chooseImage(origin+image_path+image.name)" type="button" class="btn btn--choose">
                        <img class="u-img-responsive" :src="origin+image_path+image.name" :alt="image.name">
                    </button>
                    <button type="button" @click="removeImage(image.id)" class="btn btn-danger btn--remove">&times;</button>
                </div>
            </div>
            <div slot="footer">
                <div class="clearfix"></div>
                <div class="pull-right">
                    <input type="file" @change="onImageChange" id="file_input" name="file_input" class="hidden">
                    <button type="button" @click="fileClick" class="btn btn-primary">Or Send File...</button>
                    <button type="button" @click="showModalFeatured = false" class="btn btn-default">Cancel</button>
                </div>
            </div>
        </modal>
        <!-- \modal library image -->
    </div>
</template>

<script>
    import modal from './ModalComponent.vue';

    export default {
        props: ['item'],
        components: {
            modal
        },
        data() {
            return {
                showModalFeatured: false,
                origin: window.location.origin + '/',
                image_path: 'storage/images/',
                images: [],
                image: {},
            }
        },
        methods: {
            fetchImages() {
                this.showModalFeatured = true;

                axios.get('/api/files')
                    .then(response => response.data)
                    .then(data => {
                        this.images = data; // fill the array with all the images on database
                    });
            },
            chooseImage(fileName) {
                this.showModalFeatured = false; // hide the modal
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
                            swal('Success!', 'File saved', 'success');
                            // reload files
                            this.fetchImages();
                        } else {
                            swal('Error!', 'File not saved, file too large [2MB Max]', 'error');
                        }
                    }).catch(function () {
                        swal('Error!', 'File not sent', 'error');
                    });
            },
            // remove image
            removeImage(id) {
                axios.post('/api/files/delete', {
                        data: id
                    })
                    .then(response => {
                        // success alert
                        swal('Success!', 'File Deleted', 'success');
                        this.fetchImages();
                    })
            }
        }
    }
</script>

<style scoped>
    .btn--choose {
        border: 1px solid #999;
        background-color: #f2f2f2;
        width: 210px;
        height: 210px;
        float: left;
        margin: 5px;
        transition: all 0.3s ease;
    }

    .btn--choose:hover {
        background-color: #999;
    }

    .btn--choose:focus {
        background-color: #999;
    }
</style>