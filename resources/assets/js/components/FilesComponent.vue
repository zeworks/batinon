<template>
    <div>
        <div class="box box-success">
            <div class="box-body">
                <div class="table-responsive">
                    <!-- files list -->
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>URL File</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#1</td>
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
        <modal v-if="showModal" @close="showModal = false" @submit="saveData">
            <h3 slot="header">Send New File</h3>
            <div slot="body">
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" id="exampleInputFile">
                  <p class="help-block">This file will be visible on the <b>files</b> list.</p>
                </div>
            </div>
        </modal>
        <!-- \modal send file -->
        <!-- modal library file -->
        <modal v-if="showModalLibrary" @close="showModalLibrary = false" @submit="saveData">
            <h3 slot="header">Files Libray</h3>
            <div slot="body">
                <p>Libray here!</p>
            </div>
        </modal>
        <!-- \modal library file -->
        <!-- modal remove file -->
        <modal v-if="showModalRemove" @close="showModalRemove = false" @submit="saveData">
            <h3 slot="header">Remove File</h3>
            <div slot="body" class="text-center">
                <h3>Do you really want to delete this file?</h3>
            </div>
            <div slot="footer">
                <button class="btn btn-flat btn-success" @click="$emit('submit')">
                Delete
                </button>
                <button class="btn btn-flat btn-default" @click="$emit('close')">
                Close
                </button>
            </div>
        </modal>
        <!-- \modal remove file -->
    </div>
</template>

<script>
    import Vue from 'vue';
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
                console.log('saved!');
            }
        }
    }
</script>




