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
                                        <div v-for="(navItem,index) in navigationItem" :key="index">{{navItem.name}}</div>
                                    </td>
                                    <td><button class="c-btn c-btn--primary" @click="remove(nav.id)"><i class="fas fa-trash"></i></button></td>
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
                        <button class="c-btn c-btn--primary float-right" @click="openModal">Add new</button>
                    </div>
                </div>
            </b-col>
        </b-row>
        <modal v-if="showModal">
            <h3 slot="header" class="f-subtitle">Add new navigation</h3>
            <div slot="body">
                <form>
                    <div class="c-form">
                        <label for="menu_title" class="c-form__label">Title*</label>
                        <input required type="text" id="menu_title" v-model="navigation.title" placeholder="ex: menu, footer menu, etc."
                            name="menu_title" class="c-form__input">
                    </div>
                    <h5>Menu item</h5>
                    <div class="c-form">
                        <label for="menu_name" class="c-form__label">Name*</label>
                        <input required type="text" id="menu_name" v-model="navigationItem.name" name="menu_name"
                            placeholder="ex: About, etc." class="c-form__input">
                    </div>
                    <div class="c-form">
                        <label for="menu_link" class="c-form__label">Link*</label>
                        <input required type="text" id="menu_link" v-model="navigationItem.url" name="menu_link"
                            placeholder="ex: /about-us" class="c-form__input">
                        <p class="c-form__help">You can copy the slug from the page detail</p>
                    </div>
                    <!-- <label class="typo__label">Tagging</label>
                    <multiselect tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="name"
                        track-by="title" :options="options.title" :multiple="true" :taggable="true" ></multiselect> -->
                </form>
            </div>
            <div slot="footer">
                <div class="float-right">
                    <button type="button" @click="showModal = false" class="c-btn c-btn--text">Cancel</button>
                    <button @click="saveData" type="submit" class="c-btn c-btn--primary">Save</button>
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
                // options: [],
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
            // this.fetchPages();
        },
        methods: {
            openModal() {
                this.showModal = true;
            },
            // fetchPages() {
            //     axios.get('/api/pages')
            //         .then(response => response.data)
            //         .then(data => {
            //             this.options = data;
            //         });
            // },
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
                        title: this.navigation.title,
                        name: this.navigationItem.name,
                        url: this.navigationItem.url,
                    })
                    .then(response => {
                        if (response.data.success) {
                            // success
                            if (response.data.returnId) {
                                swal('Sucesso!', 'Page saved', 'success');
                                this.showModal = false;
                                this.fetchNavigation();
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
            }
        }
    }
</script>

<style scoped>

</style>