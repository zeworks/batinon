<template>
    <div>
        <div class="box box-success">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Page Title</th>
                                <th>Page Slug</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(page,index) in pages" :key="index">
                                <td>
                                    #{{page.id}}
                                </td>
                                <td><a :href="('./pages/edit/'+page.id)">{{page.name}}</a></td>
                                <td>{{page.slug}}</td>
                                <td>
                                    <span class="label" :class="{'label-success' : page.status == '1', 'label-danger' : page.status == '0'}">
                                        <span v-if="page.status == 1">
                                            Active
                                        </span>
                                        <span v-if="page.status == 0">
                                            Inactive
                                        </span>
                                    </span>
                                </td>
                                <td>{{page.creation_date}}</td>
                                <td>
                                    <div class="pull-right">
                                        <a :href="('./pages/edit/'+page.id)" class="btn btn-warning" ><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-danger" @click="showModalRemove = true"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer clearfix">
                <a :href="('./pages/new')" class="btn btn-sm btn-success btn-flat pull-right">Create New</a>
            </div>
        </div>
        <!-- modal remove file -->
        <modal v-if="showModalRemove">
            <h3 slot="header">Delete Page</h3>
            <div slot="body" class="text-center">
                <h3>Do you really want to delete this page?</h3>
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
            removeFile(){
                // hide remove modal
                this.showModalRemove = false;
                // success alert
                swal('Success!','Page Deleted','success');
            }
        }
    }
</script>

