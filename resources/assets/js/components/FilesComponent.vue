<template>
    <div>
        <div class="box box-success">
            <div class="box-body">
                <div class="table-responsive">
                    <!-- files list -->
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th width="60">ID</th>
                                <th width="100"></th>
                                <th>Date</th>
                                <th>URL File</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#1</td>
                                <td>
                                    <div class="image-to-preview">
                                        <img src="https://dummyimage.com/70x50/000/fff" alt="dummy image">
                                    </div>
                                </td>
                                <td>data</td>
                                <td><input type="text" disabled value="https://dummyimage.com/836x525/000/fff" class="form-control"></td>
                                <td><button class="btn btn-danger pull-right" @click="showModalRemove = true"><i class="fa fa-trash-o"></i></button></td>
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
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" id="exampleInputFile">
                  <p class="help-block">This file will be visible on the <b>files</b> list.</p>
                </div>
            </div>
            <div slot="footer">
                <div class="clearfix"></div>
                <div class="pull-right">
                    <button @click="saveData" class="btn btn-success">Send</button>
                    <button @click="showModal = false" class="btn btn-default">Cancel</button>
                </div>
            </div>
        </modal>
        <!-- \modal send file -->
        <!-- modal library file -->
        <modal v-if="showModalLibrary">
            <h3 slot="header">Files Libray</h3>
            <div slot="body">
                <p>Libray here!</p>
            </div>
            <div slot="footer">
                <div class="clearfix"></div>
                <div class="pull-right">
                    <button @click="saveData" class="btn btn-success">Send</button>
                    <button @click="showModalLibrary = false" class="btn btn-default">Cancel</button>
                </div>
            </div>
        </modal>
        <!-- \modal library file -->
        <!-- modal remove file -->
        <modal v-if="showModalRemove">
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
    </div>
</template>

<script>
    import axios from 'axios';
    import modal from './ModalComponent.vue';

    export default {
        data() {
            return {
                pages : [],
                showModal : false,
                showModalLibrary : false,
                showModalRemove : false,
            }
        },
        components: {
            modal
        },
        created(){
            this.fetchPages();
        },
        methods: {
            fetchPages(){
                axios.get('/api/pages')
                .then( response => response.data)
                .then( data => {
                    this.pages = data;
                });
            },
            saveData(){
                this.showModal = false;
                // success alert
                swal('Sucesso!','File Sent','success');
            },
            removeFile(){
                // hide remove modal
                this.showModalRemove = false;
                // success alert
                swal('Sucesso!','File Deleted','success');
            }
        }
    }
</script>




