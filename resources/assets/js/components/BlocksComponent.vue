<template>
    <div>
        <div class="box box-default">
            <div class="box-header">
                <div class="box-title">{{title}}</div>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="block_title">Title*</label>
                    <input type="text" id="block_title" name="block_title" class="form-control" v-model="item.b_title">
                </div>
                <div class="form-group">
                    <label for="block_summary">Summary</label>
                    <vueEditor id="block_summary" name="block_summary" v-model="item.b_summary"></vueEditor>
                </div>
                <div class="form-group">
                    <label for="block_description">Description</label>
                    <vueEditor id="block_description" name="block_description" v-model="item.b_description"></vueEditor>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <p class="help-block">Choose wich image you want to display into this block</p>
                    <br>
                    <div v-if="item.b_image" class="block-image">
                        <img :src="item.b_image" alt class="img-responsive">
                        <br>
                    </div>
                    <button type="button" class="btn btn-primary" @click="fetchBlockImages">Choose Image</button>
                </div>
            </div>
        </div>
        <!-- modal choose block image -->
        <modal v-if="showModalBlockImages">
            <h3 slot="header">Choose your Block Image</h3>
            <div slot="body" class="clearfix">
                <div v-for="(image,index) in images" :key="index" class="modal-image clearfix">
                    <button @click="chooseImage(origin+image_path+image.name)" type="button" class="btn btn--choose">
                        <img class="img-responsive" :src="origin+image_path+image.name" :alt="image.name">
                    </button>
                    <button type="button" @click="removeBlockImage(image.id)" class="btn btn-danger btn--remove">&times;</button>
                </div>
            </div>
            <div slot="footer">
                <div class="clearfix"></div>
                <div class="pull-right">
                    <input type="file" @change="onBlockImageChange" id="file_blockImages" name="file_blockImages" class="hidden">
                    <button type="button" @click="fileClick" class="btn btn-primary">Or Send File...</button>
                    <button type="button" @click="showModalBlockImages = false" class="btn btn-default">Cancel</button>
                </div>
            </div>
        </modal>
        <!-- :modal choose block image -->
    </div>
</template>

<script>
    import modal from './ModalComponent.vue';

    export default {
        props: ['item','title'],
        components: {
            modal
        },
        data() {
            return {
                showModalBlockImages : false,
                origin: window.location.origin + '/',
                image_path: 'storage/images/',
                images: [],
                image: {},
            }
        },
        methods:{
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

    .block-image{
        max-width: 400px;
    }
</style>