<template>
    <div>
        <div class="row">
            <div class="col-sm-6 col-md-offset-1 col-md-3">
                <h1>Navigation</h1>
                <br>
                <p>
                    Menus, or link lists, help your customers navigate around your online store.
                </p>
                <p>
                    You can also create nested menus to display drop-down menus, and group products or pages together.
                </p>
            </div>
            <div class="col-sm-6 col-md-offset-1 col-md-6">
                <br>
                <br>
                <div class="box box-default">
                    <div class="box-body">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Menu Items</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(nav,index) in navigation" :key="index">
                                    <td>{{nav.title}}</td>
                                    <td><div v-for="(navItem,index) in navigationItem" :key="index">{{navItem.name}}</div></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-primary pull-right" @click="openModal">Add new</button>
                    </div>
                </div>
            </div>
        </div>
        <modal v-if="showModal">
            <h3 slot="header">Add new navigation</h3>
            <div slot="body">
                <form @submit.prevent="saveData">
                    <div class="form-group">
                        <label for="menu_title">Title*</label>
                        <input required type="text" id="menu_title" v-model="navigation.title" placeholder="ex: menu, footer menu, etc."
                            name="menu_title" class="form-control">
                    </div>
                    <h3>Menu item</h3>
                    <div class="form-group">
                        <label for="menu_name">Name*</label>
                        <input required type="text" id="menu_name" v-model="navigationItem.name" name="menu_name" placeholder="ex: About, etc." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="menu_link">Link*</label>
                        <input required type="text" id="menu_link" v-model="navigationItem.url" name="menu_link" placeholder="ex: /about-us" class="form-control">
                        <p class="help-block">You can copy the slug from the page detail</p>
                    </div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" @click="showModal = false" class="btn btn-default">Cancel</button>
                    </div>
                </form>
            </div>
        </modal>
    </div>
</template>

<script>
    import axios from 'axios';
    import modal from './ModalComponent.vue';

    export default {
        components: {
            modal
        },
        data() {
            return {
                showModal: false,
                navigation: {
                    title: '',
                },
                navigationItem: {
                    name : '',
                    url  : '',
                }
            }
        },
        created() {
            this.fetchNavigation();
        },
        methods: {
            openModal() {
                this.showModal = true;
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
                        title: this.navigation.title,
                        name : this.navigationItem.name,
                        url  : this.navigationItem.url,
                    })
                    .then(response => {
                        if (response.data.success) {
                            // success
                            if(response.data.returnId){
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
            }
        }
    }
</script>

<style scoped>

</style>