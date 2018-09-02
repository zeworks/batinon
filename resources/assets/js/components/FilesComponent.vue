<template>
    <div>
        <div class="box box-success">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>File Name</th>
                                <th>URL File</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer clearfix">
                <button class="btn btn-sm btn-success btn-flat pull-right" @click="showModal = true">Send File</button>
            </div>
        </div>
        <modal v-if="showModal" @close="showModal = false" @submit="saveData">
            <h3 slot="header">Send New File</h3>
            <div slot="body">
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" id="exampleInputFile">

                  <p class="help-block">Example block-level help text here.</p>
                </div>
            </div>
        </modal>
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




