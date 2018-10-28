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
                                        <td><a :href="('./pages/edit/'+page.id)">{{page.title}}</a></td>
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
                                        <td>{{page.created_at}}</td>
                                        <td>
                                            <div class="float-right">
                                                <a :href="('./pages/edit/'+page.id)" class="c-btn c-btn--primary c-btn--small">Edit</a>
                                                <button class="c-btn c-btn--link c-btn--small" @click="openModalDelete(page.id)">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="5">
                                            <div class="text-center">
                                                <small>You have no pages created yet!</small>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="c-card__footer clearfix">
                            <a :href="('./pages/new')" class="c-btn c-btn--primary float-right">Create New</a>
                        </div>
                    </div>
                </b-col>
            </b-row>
        </b-container>

        <!-- modal remove file -->
        <modal v-if="showModalRemove" :removeid="removeId">
            <div slot="header">Delete Page</div>
            <div slot="body" class="text-center">
                <h6>Do you really want to delete this page?</h6>
            </div>
            <div slot="footer">
                <div class="clearfix"></div>
                <div class="float-right">
                    <button @click="showModalRemove = false" class="c-btn c-btn--text">No</button>
                    <button @click="removeFile" class="c-btn c-btn--primary">Yes</button>
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
                removeId: '',
                pages: [],
                showModalRemove: false,
            }
        },
        components: {
            modal
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
            openModalDelete(id) {
                // hide remove modal
                this.showModalRemove = true;
                this.removeId = id;
            },
            removeFile() {
                axios.post('/api/pages/delete', {
                        data: this.removeId
                    })
                    .then(response => {
                        // success alert
                        swal('Success!', 'Page Deleted', 'success');
                        this.fetchPages();
                        this.showModalRemove = false;
                    })
            },
        }
    }
</script>