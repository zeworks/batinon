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
                    <p>
                        You can also create nested menus to display drop-down menus, and group products or pages
                        together.
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
                                    <th>Menu Items</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody v-if="navigation[0] != null">
                                <tr v-for="(nav,index) in navigation" :key="index" class="c-table__row">
                                    <td>{{nav.title}}</td>
                                    <td>
                                        <div v-for="(navItem,index) in navigationItem" :key="index" v-if="navItem.parent_id == nav.id">
                                            {{navItem.name}}
                                        </div>
                                    </td>
                                    <td>
                                        <button class="c-btn c-btn--primary" @click="edit(nav.id)"><i class="fas fa-edit"></i></button>
                                        <button class="c-btn c-btn--text" @click="remove(nav.id)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="3">
                                        <div class="text-center">
                                            <small>You have no menu items yet!</small>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="c-card__footer clearfix">
                        <button class="c-btn c-btn--primary float-right" @click="showModal = true">Add new</button>
                    </div>
                </div>
            </b-col>
        </b-row>
        <modal v-if="showModal && !editId">
            <h3 slot="header" class="f-subtitle">Add new navigation</h3>
            <div slot="body">
                <div class="c-form">
                    <label for="menu_title" class="c-form__label">Title*</label>
                    <input required type="text" id="menu_title" v-model="navigation.title" placeholder="ex: menu, footer menu, etc."
                        name="menu_title" class="c-form__input">
                </div>
                <h5>Menu item</h5>
                <label class="typo__label">Page name</label>
                <multiselect v-model="value" tag-placeholder="Add this as new tag" placeholder="Search or add a tag"
                    :options="options" :multiple="true" :taggable="true" label="title" track-by="title"></multiselect>
            </div>
            <div slot="footer">
                <div class="float-right">
                    <button type="button" @click="showModal = false" class="c-btn c-btn--text">Cancel</button>
                    <button type="button" @click="saveData" class="c-btn c-btn--primary">Save</button>
                </div>
            </div>
        </modal>
        <modal v-if="showModal && editId">
            <h3 slot="header" class="f-subtitle">Edit navigation</h3>
            <div slot="body" v-for="(nav,index) in navigation" :key="index">
                <div class="c-form" >
                    <label for="menu_title" class="c-form__label">Title*</label>
                    <input required type="text" id="menu_title" v-model="nav.title" placeholder="ex: menu, footer menu, etc."
                        name="menu_title" class="c-form__input">
                </div>
                <h5>Menu item</h5>
                <label class="typo__label">Page name</label>
                <div v-for="(navItem,index) in navigationItem" :key="index" v-if="navItem.parent_id == nav.id">
                    <multiselect v-model="navItem.title" tag-placeholder="Add this as new tag" placeholder="Search or add a tag"
                        :options="options" :multiple="true" :taggable="true" label="title" track-by="title"></multiselect>
                </div>
            </div>
            <div slot="footer">
                <div class="float-right">
                    <button type="button" @click="showModal = false" class="c-btn c-btn--text">Cancel</button>
                    <button type="button" @click="saveData" class="c-btn c-btn--primary">Save</button>
                </div>
            </div>
        </modal>
    </b-container>
</template>

<script>
    import axios from 'axios';
    import modal from './ModalComponent.vue';
    import Multiselect from 'vue-multiselect'

    export default {
        components: {
            modal,
            Multiselect
        },
        data() {
            return {
                editId: null,
                value: [],
                options: {},
                navigation: {
                    title: '',
                },
                navigationItem: {
                    name: '',
                    url: '',
                }
            }
        },
        created() {
            this.fetchNavigation();
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
            fetchNavigation() {
                axios.get('/api/navigation')
                    .then(response => response.data)
                    .then(data => {
                        this.navigation = data.navigations;
                        this.navigationItem = data.navigationItems;
                    });
            },
            saveData() {
                axios.post('/api/navigation/add', {
                        menu_title: this.navigation.title,
                        navigation_item: this.value,
                    })
                    .then(response => {
                        if (response.data.success) {
                            // success
                            if (response.data.returnId) {
                                swal('Sucesso!', 'Page saved', 'success');
                                this.showModal = false;
                                this.fetchNavigation();
                                this.value = [];
                            }

                        } else
                            swal('Erro!', 'Page not saved', 'error');
                    })
                    .catch(error => {
                        swal('Erro!', 'Please fill all the required fields.', 'error');
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
                            axios.post('/api/navigation/delete', {
                                    data: id
                                })
                                .then(response => {
                                    // success alert
                                    swal('Success!', 'Menu Item Deleted', 'success');
                                    this.fetchNavigation();
                                })
                        } else {
                            swal.close();
                        }
                    });
            },
            edit(id) {
                this.showModal = true;
                this.editId = id;
                // axios.get('/api/navigation/edit/' + id)
                //     .then(response => response.data)
                //     .then(data => {
                //         this.navigation = data.navigations;
                //         this.navigationItem = data.navigationItems;
                //     });
            }
        }
    }
</script>

<style scoped>

</style>