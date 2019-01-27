<template>
    <div>
		<button type="button" class="c-btn c-btn--primary u-margin--top-bottom-s" @click="fetchImages">Choose Images</button>
        <b-row>
            <b-col sm="3" v-for="(image,index) in item" :key="index">
                <button type="button" @click="unselectImage(image)" class="c-btn c-btn--rounded c-btn--danger">&times;</button>
                <img class="u-img-responsive" v-if="image" :src="origin+image_path+image" alt="">
            </b-col>
        </b-row>
        <v-modal v-if="showModal">
            <h3 slot="header" class="f-subtitle">Choose which images you want in the slider</h3>
            <div slot="body">
                <div v-if="images==0" class="text-center">
                    <span>No files in storage yet!</span>
                </div>
                <b-row v-else>
                    <b-col sm="2" v-for="(image,index) in images" :key="index">
						<v-slider-images 
						@unselectImage="unselectImage" 
						@selectImage="selectImage" 
						@removeImage="removeSliderImage"
						:images="image" 
						:index="index"
                        :checked-images="checkedImages"></v-slider-images>
                    </b-col>
                </b-row>
            </div>
            <div slot="footer">
                <div class="clearfix"></div>
                <div class="float-right">
                    <input type="file" @change="onImageChange" id="files_multiple" name="files_multiple" class="hidden">
                    <button type="button" @click="showModal = false" class="c-btn c-btn--text">Cancel</button>
                    <button type="button" @click="fileClick" class="c-btn c-btn--text">Update new File</button>
                    <button type="button" @click="showModal = false" class="c-btn c-btn--primary">Save</button>
                </div>
            </div>
        </v-modal>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
		props: ['item'],
        data() {
            return {
				images: [],
                image: {},
                checkedImages: [],
            }
        },
        mounted(){
            this.checkedImages = this.item;
        },
        methods: {
            fetchImages() {
                this.showModal = true;

                axios.get('/api/files')
                    .then(response => response.data)
                    .then(data => {
                        this.images = data; // fill the array with all the images on database
                    });
			},
			// if the user wants to upload a new file...
            fileClick() {
                $('#files_multiple').click();
            },
            // every time he changes the images...
            onImageChange(e) {
                this.image = document.querySelector('#files_multiple').files[0];
                this.uploadImage();
			},
			/**
			 * 
			 * When the user wants to upload a new image
			 */
            uploadImage() {

                const formData = new FormData();
                formData.append('image', this.image);

                axios.post('/api/files/add', formData)
                    .then(response => {
                        if (response.data.success) {
                            swal('Success!', response.data.message, 'success');
                            // reload files
                            this.fetchImages();
                        } else {
                            swal('Error!', response.data.message, 'error');
                        }
                    }).catch(function () {
                        swal('Error!', response.data.message, 'error');
                    });
			},
			removeSliderImage(id) {
                swal({
                        title: "Are you sure?",
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
                                    swal('Success!', response.data.message, 'success');
                                    this.fetchImages();
                                })
                        } else {
                            swal.close();
                        }
                    });
            },
			selectImage(fileName) {
                this.checkedImages.push(fileName);
                this.updateImagesArray();
            },
			unselectImage(fileName) {
				this.checkedImages = this.checkedImages.filter(function (item) {
                    return fileName != item;
                });
                this.updateImagesArray();
            },
            updateImagesArray(){
                this.$emit('updateSlider', this.checkedImages);
            }
        }
    }
</script>

<style scoped lang="scss">
    
</style>