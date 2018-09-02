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
                                        <a :href="('./pages/edit/'+page.id)" class="btn btn-warning" >Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer clearfix">
                <a :href="('./pages/new')" class="btn btn-sm btn-info btn-flat pull-right">Create New</a>
            </div>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue';
    import axios from 'axios';

    export default {
        data() {
            return {
                pages : [],
            }
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
            }
        }
    }
</script>

