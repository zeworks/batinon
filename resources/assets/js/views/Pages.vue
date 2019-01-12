<template>
    <b-container fluid>
        <b-row>
            <b-col sm="12">
                <div class="c-card">
                    <div class="c-card__body">
                        <table class="c-table no-margin">
                            <thead class="c-table__header">
                                <tr>
                                    <th>ID</th>
                                    <th>Page Title</th>
                                    <th>Page Slug</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody v-if="pages[0] != null">
                                <tr class="c-table__row" v-for="(page,index) in pages" :key="index">
                                    <td>
                                        #{{page.id}}
                                    </td>
                                    <td><router-link :to="'/admin/pages/edit/'+page.id">{{page.title}}</router-link></td>
                                    <td>{{page.slug}}</td>
                                    <td>
                                        <div class="u-tag" :class="{'u-tag--success' : page.status == '1', 'u-tag--danger' : page.status == '0'}">
                                            <span v-if="page.status == 1">
                                                Active
                                            </span>
                                            <span v-if="page.status == 0">
                                                Inactive
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{page.created_at}}</td>
                                    <td>
                                        <div class="float-right">
                                            <router-link :to="'/admin/pages/edit/'+page.id" class="c-btn c-btn--text c-btn--small">Edit</router-link>
                                            <button class="c-btn c-btn--danger c-btn--small" @click="remove(page.id)">Delete</button>
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
                        <router-link to="/admin/pages/add" class="c-btn c-btn--primary float-right">Create New</router-link>
                    </div>
                </div>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                tableHeaders: [
                    'ID',
                    'Page Title',
                    'Page Slug',
                    'Status',
                    'Date',
                    ''
                ],
                pages: [],
            }
        },
        created() {
            this.fetchPages();
        },
        methods: {
            fetchPages() {
                axios.get('/api/pages')
                    .then(response => response.data)
                    .then(data => {
                        this.pages = data;
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
                            axios.post('/api/pages/delete', {
                                    data: id
                                })
                                .then(response => {
                                    // success alert
                                    swal('Success!', 'Page Deleted', 'success');
                                    this.fetchPages();
                                })
                        } else {
                            swal.close();
                        }
                    });
            }
        }
    }
</script>