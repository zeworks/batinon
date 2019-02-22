<template>
    <b-container fluid>
        <b-row>
            <b-col sm="6" offset-md="1" md="3">
                <h2 class="u-font-bold">Navigation</h2>
                <br>
                <blockquote>
                    <p>
                        Menus, or link lists, help your customers navigate around your online store.
                    </p>
                </blockquote>
            </b-col>
            <b-col sm="6" offset-md="1" md="6">
                <br>
                <br>
                <div class="c-card">
                    <div class="c-card__body">
                        <table class="c-table">
                            <thead class="c-table__header">
                                <tr>
                                    <th>Title</th>
                                    <th>Menu Pages</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(nav,index) in navigation" :key="index" class="c-table__row">
                                    <td>{{nav.title}}</td>
                                    <td>
                                        <div v-for="(navItem,index) in navigationItem" :key="index">
                                            <div v-if="navItem.parent_id === nav.id">
                                                {{navItem.title}}
                                            </div>
                                        </div>
                                    </td>
                                    <td width="10">
                                        <button class="c-btn c-btn--link" @click="openModal(nav.id)"><i class="fas fa-edit"></i></button>
                                    </td>
                                    <td>
                                        <v-statusComponent @changeStatus="editStatus" :item="nav" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </b-col>
        </b-row>
        <v-modal v-if="showModal">
            <h3 slot="header" class="f-subtitle">Edit navigation</h3>
            <div slot="body">
                <label class="typo__label">Page name</label>
                <multiselect v-model="value" tag-placeholder="Add this as new tag" placeholder="Search or add a tag"
                    :options="options" :multiple="true" :taggable="true" label="title" track-by="title"></multiselect>
            </div>
            <div slot="footer">
                <div class="float-right">
                    <button type="button" @click="showModal = false" class="c-btn c-btn--text">Cancel</button>
                    <template v-if="newItem">
                        <button type="button" @click="insertData" class="c-btn c-btn--primary">Save</button>
                    </template>
                    <template v-else>
                        <button type="button" @click="editData" class="c-btn c-btn--primary">Save</button>
                    </template>
                </div>
            </div>
        </v-modal>
    </b-container>
</template>

<script>
    import axios from 'axios';
    import Multiselect from 'vue-multiselect'

    export default {
        components: {
            Multiselect
        },
        data() {
            return {
                value: [],
                options: {},
                navigation: [],
                navigationItem: [],
                navSelected: {},
                newItem: false,
                navStatus: []
            }
        },
        mounted() {
            this.fetchNavigationTable();
            this.fetchPages();
        },
        methods: {
            fetchPages() {
                axios.get('/api/pages')
                    .then(response => response.data)
                    .then(data => {
                        this.options = data;
                    });
            },
            fetchNavigationTable() {
                axios.get('/api/navigation')
                    .then(response => response.data)
                    .then(data => {
                        this.navigation = data.navigations;
                        this.navigationItem = data.navigationItems;
                    });
            },
            getSelected() {
                axios.get('/api/navigation/' + this.navSelected.menuType)
                    .then(response => response.data)
                    .then(data => {
                        this.value = data.navigationItems
                        if (!this.value.length > 0) {
                            this.newItem = true
                        }
                    });
            },
            insertData() {
                axios.post('/api/navigation/add', {
                        items: this.value,
                        menu: this.navSelected.menuType
                    })
                    .then(response => {
                        if (response.data.success) {
                            swal('Sucesso!', response.data.message, 'success');
                            this.showModal = false
                            this.fetchNavigationTable();
                            this.newItem = false;
                        } else {
                            swal('Erro!', response.data.message, 'error');
                        }
                    })
                    .catch(error => {
                        swal('Erro!', response.data.message, 'error');
                    });
            },
            editData() {
                axios.put('/api/navigation/edit', {
                        items: this.value,
                        menu: this.navSelected.menuType
                    })
                    .then(response => {
                        if (response.data.success) {
                            swal('Sucesso!', response.data.message, 'success');
                            this.showModal = false
                            this.fetchNavigationTable();
                            this.newItem = false;
                        } else {
                            swal('Erro!', response.data.message, 'error');
                        }
                    })
                    .catch(error => {
                        swal('Erro!', response.data.message, 'error');
                    });
            },
            editStatus() {
                this.navStatus = []

                for (let index = 0; index < this.navigation.length; index++) {
                    this.navStatus.push({
                        id: this.navigation[index].id,
                        status: this.navigation[index].status
                    })
                }
                
                axios.put('/api/navigation/edit', { status: this.navStatus })
                    
            },
            openModal(id) {
                this.showModal = true;
                this.navSelected.menuType = id;
                this.getSelected();
            }
        }
    }
</script>