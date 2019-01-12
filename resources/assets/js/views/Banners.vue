<template>
    <div>
        <b-container fluid>
            <b-row>
                <b-col sm="12">
                    <div class="c-card">
                        <div class="c-card__body">
                            <table class="c-table no-margin">
                                <thead class="c-table__header">
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody v-if="banners[0] != null">
                                    <tr class="c-table__row" v-for="(banner,index) in banners" :key="index">
                                        <td>
                                            #{{banner.id}}
                                        </td>
                                        <td><router-link :to="'/admin/banners/edit/'+banner.id">{{banner.title}}</router-link></td>
                                        <td>
                                            <div class="u-tag" :class="{'u-tag--success' : banner.status == '1', 'u-tag--danger' : banner.status == '0'}">
                                                <span v-if="banner.status == 1">
                                                    Active
                                                </span>
                                                <span v-if="banner.status == 0">
                                                    Inactive
                                                </span>
                                            </div>
                                        </td>
                                        <td>{{banner.created_at}}</td>
                                        <td>
                                            <div class="float-right">
                                                <router-link :to="'/admin/banners/edit/'+banner.id" class="c-btn c-btn--text c-btn--small">Edit</router-link>
                                                <button class="c-btn c-btn--danger c-btn--small" @click="remove(banner.id)">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="5">
                                            <div class="text-center">
                                                <br>
                                                <p>You have no pages created yet!</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="c-card__footer clearfix">
                            <router-link to="/admin/banners/add" class="c-btn c-btn--primary float-right">Create New</router-link>
                        </div>
                    </div>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                banners: [],
            }
        },
        created() {
            this.fetch();
        },
        methods: {
            fetch() {
                axios.get('/api/banners')
                    .then(response => response.data)
                    .then(data => {
                        this.banners = data;
                    });
            },
            remove(id) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this content!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            axios.post('/api/banners/delete', {
                                    data: id
                                })
                                .then(response => {
                                    // success alert
                                    swal('Success!', 'Banner Deleted', 'success');
                                    this.fetch();
                                })
                        } else {
                            swal.close();
                        }
                    });
            }
        }
    }
</script>