<template>
    <div>
        <div class="box box-danger">
            <div class="box-body">
                <div class="table-responsive">
                    <!-- files list -->
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th width="60">ID</th>
                                <th width="100"></th>
                                <th width="200">Date</th>
                                <th>URL File</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(file,index) in files" :key="index">
                                <td>#{{file.id}}</td>
                                <td>
                                    <a href="#" @click="imagePreview(origin+image_path+file.name)" class="image-to-preview" v-if="file.name">
                                        <img width="50" :src="origin+image_path+file.name" alt="dummy image">
                                    </a>
                                </td>
                                <td>{{file.created_at}}</td>
                                <td><input type="text" disabled  :value="origin+image_path+file.name" class="form-control"></td>
                                <td><button class="btn btn-danger pull-right" @click="openModalDelete(file.id)"><i class="fa fa-trash-o"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- \files list -->
                </div>
            </div>
            <div class="box-footer clearfix">
                <div class="pull-right">
                    <button class="btn btn-sm btn-success btn-flat" @click="showModal = true">Send File</button>
                    &nbsp;
                    <button class="btn btn-sm btn-default btn-flat" @click="showModalLibrary = true">Show All</button>
                </div>
            </div>
        </div>
        <!-- modal send file -->
        <modal v-if="showModal">
            <h3 slot="header">Send New File</h3>
            <div slot="body">
                <form @submit.prevent="uploadImage">
                    <div class="form-group">
                        <label for="file_input">File input</label>
                        <input type="file" id="file_input" @change="onImageChange" name="file_input">
                        <p class="help-block">This file will be visible on the <b>files</b> list.</p>
                    </div>
                    <hr>
                    <div class="clearfix"></div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success">Send</button>
                        <button type="button" @click="showModal = false" class="btn btn-default">Cancel</button>
                    </div>
                </form>
            </div>
        </modal>
        <!-- \modal send file -->
        <!-- modal library file -->
        <modal v-if="showModalLibrary">
            <h3 slot="header">Files Libray</h3>
            <div slot="body" class="clearfix">
                <p>Libray here!</p>
                <div v-for="(file,index) in files" :key="index">
                    <div class="col-sm-4">
                        <img class="img-responsive" :src="origin+image_path+file.name" :alt="file.name">
                    </div>
                </div>
            </div>
            <div slot="footer">
                <div class="clearfix"></div>
                <div class="pull-right">
                    <button @click="showModalLibrary = false" class="btn btn-default">Cancel</button>
                </div>
            </div>
        </modal>
        <!-- \modal library file -->
        <!-- modal remove file -->
        <modal v-if="showModalRemove" :removeid="removeId">
            <h3 slot="header">Delete File</h3>
            <div slot="body" class="text-center">
                <h3>Do you really want to delete this file?</h3>
            </div>
            <div slot="footer">
                <div class="clearfix"></div>
                <div class="pull-right">
                    <button @click="removeFile" class="btn btn-success">Yes</button>
                    <button @click="showModalRemove = false" class="btn btn-default">No</button>
                </div>
            </div>
        </modal>
        <!-- \modal remove file -->
        <!-- modal preview image -->
        <modal v-if="showModalPreview">
            <div slot="body">
                <img :src="imageToPreview" class="preview-image img-responsive">
            </div>
            <div slot="footer">
                <button @click="showModalPreview = false" class="btn btn-default">Ok</button>
            </div>
        </modal>
        <!-- \modal preview image -->
    </div>
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
                showModalRemove  : false,
                showModalPreview : false,
            }
        },
        components: {
            modal
        },
        created(){
            this.fetchFiles();
        },
        methods: {
            fetchFiles(){
                axios.get('/api/files')
                .then( response => response.data)
                .then( data => {
                    this.files = data;
                });
            },
            openModalDelete(id){
                // hide remove modal
                this.showModalRemove = true;
                
                this.removeId = id;
                
            },
            removeFile(){
                axios.post('/api/files/delete',{data: this.removeId})
                .then( response => {
                    // success alert
                    swal('Sucesso!','File Deleted','success');
                    this.fetchFiles();
                    this.showModalRemove = false;
                })
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
                        swal('Sucesso!','File saved','success');
                        // reload files
                        this.fetchFiles();
                    }else{
                        swal('Erro!','File not saved, file too large [2MB Max]','error');
                    }
                }).catch(function(){
                    swal('Erro!','File not sent','error');
                });
            },
            imagePreview(file){
                this.showModalPreview = true;
                this.imageToPreview = file;
            }
        }
    }
</script>




