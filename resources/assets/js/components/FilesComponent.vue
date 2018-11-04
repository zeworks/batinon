<template>
    <b-container fluid>
        <div class="c-card">
            <div class="c-card__body">
                <!-- files list -->
                <table class="c-table no-margin">
                    <thead class="c-table__header">
                        <tr>
                            <th width="60">ID</th>
                            <th width="100"></th>
                            <th width="200">Date</th>
                            <th>URL File</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody v-if="files[0] != null">
                        <tr class="c-table__row" v-for="(file,index) in files" :key="index">
                            <td>#{{file.id}}</td>
                            <td>
                                <a href="#" @click="imagePreview(origin+image_path+file.name)" class="image-to-preview" v-if="file.name">
                                    <img width="50" :src="origin+image_path+file.name" alt="dummy image">
                                </a>
                            </td>
                            <td>{{file.created_at}}</td>
                            <td><input type="text" disabled  :value="origin+image_path+file.name" class="form-control"></td>
                            <td><button class="c-btn c-btn--primary u-icon-before" @click="removeFile(file.id)"><i class="fas fa-trash"></i> delete</button></td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="5">
                                <div class="text-center">
                                    <small>You have no files saved yet!</small>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- \files list -->
            </div>
            <div class="c-card__footer clearfix">
                <div class="float-right">
                    <button class="c-btn c-btn--text" @click="showModalLibrary = true">Show All</button>
                    &nbsp;
                    <button class="c-btn c-btn--primary" @click="showModal = true">Send File</button>
                </div>
            </div>
        </div>
        <!-- modal send file -->
        <modal v-if="showModal">
            <h3 class="f-subtitle" slot="header">Send New File</h3>
            <div slot="body">
                <form @submit.prevent="uploadImage">
                    <div class="form-group">
                        <label for="file_input">File input</label>
                        <input type="file" id="file_input" @change="onImageChange" name="file_input">
                        <p class="help-block">This file will be visible on the <b>files</b> list.</p>
                    </div>
                    <hr>
                    <div class="clearfix"></div>
                    <div class="float-right">
                        <button type="submit" class="c-btn c-btn--primary">Send</button>
                        <button type="button" @click="showModal = false" class="c-btn c-btn--link">Cancel</button>
                    </div>
                </form>
            </div>
        </modal>
        <!-- \modal send file -->
        <!-- modal library file -->
        <modal v-if="showModalLibrary">
            <h3 slot="header">Files Libray</h3>
            <div slot="body" class="clearfix">
              <b-row>
                <b-col sm="4" v-for="(file,index) in files" :key="index">
                  <img class="u-img-responsive" :src="origin+image_path+file.name" :alt="file.name">
                </b-col>
              </b-row>
            </div>
            <div slot="footer">
                <div class="clearfix"></div>
                <div class="float-right">
                    <button @click="showModalLibrary = false" class="c-btn c-btn--default">Cancel</button>
                </div>
            </div>
        </modal>
        <!-- \modal library file -->
        <!-- modal preview image -->
        <modal v-if="showModalPreview">
            <div slot="body">
                <img :src="imageToPreview" class="u-img-responsive">
            </div>
            <div slot="footer">
                <button @click="showModalPreview = false" class="btn btn-default">Close</button>
            </div>
        </modal>
        <!-- \modal preview image -->
    </b-container>
</template>

<script>
    import axios from 'axios';
    import modal from './ModalComponent.vue';

    export default {
        data() {
            return {
                removeId         : '',
                files            : [],
                image            : {},
                origin           : window.location.origin+'/',
                image_path       : 'storage/images/',
                imageToPreview   : '',
                showModal        : false,
                showModalLibrary : false,
                showModalPreview : false,
            }
        },
        components: {
            modal
        },
        created(){
            this.fetchFiles();
            document.body.addEventListener('keyup', e => {
                if (e.keyCode === 27) {
                    this.showModal = false;
                    this.showModalPreview = false;
                    this.showModalLibrary = false;
                }
            })
        },
        methods: {
            fetchFiles(){
                axios.get('/api/files')
                .then( response => response.data)
                .then( data => {
                    this.files = data;
                });
            },
            removeFile(id){
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this file!",
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
                                    swal('Success!', 'File Deleted', 'success');
                                    this.fetchFiles();
                                })
                        } else {
                            swal.close();
                        }
                    });
            },
            onImageChange(e) {
                this.image = document.querySelector('#file_input').files[0];
            },
            uploadImage(event){
                this.showModal = false;

                const formData = new FormData();
                formData.append( 'image', this.image );

                axios.post('/api/files/add', formData)
                .then(response => {
                    if(response.data.success){
                        swal('Success!','File saved','success');
                        // reload files
                        this.fetchFiles();
                    }else{
                        swal('Error!','File not saved, file too large [2MB Max]','error');
                    }
                }).catch(function(){
                    swal('Error!','File not sent','error');
                });
            },
            imagePreview(file){
                this.showModalPreview = true;
                this.imageToPreview = file;
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
