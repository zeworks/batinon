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
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="this.$root.placeholders && products.length === 0">
                                    <td colspan="5">
                                        <v-placeholder />
                                    </td>
                                </tr>
                                <tr v-if="!this.$root.placeholders && products.length === 0">
                                    <td colspan="5">
                                        <div class="text-center">
                                            <br>
                                            <p>You have no products created yet!</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else class="c-table__row" v-for="(product,index) in products" :key="index">
                                    <td>
                                        #{{product.id}}
                                    </td>
                                    <td>
                                        <router-link :to="'/admin/products/edit/'+product.id">{{product.title}}</router-link>
                                    </td>
                                    <td>{{product.slug}}</td>
                                    <td>
                                        <div class="u-tag" :class="{'u-tag--success' : product.status == '1', 'u-tag--danger' : product.status == '0'}">
                                            <span v-if="product.status == 1">
                                                Active
                                            </span>
                                            <span v-if="product.status == 0">
                                                Inactive
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{product.created_at}}</td>
                                    <td>
                                        <div class="float-right">
                                            <router-link :to="'/admin/products/edit/'+product.id" class="c-btn c-btn--text c-btn--small">Edit</router-link>
                                            <button class="c-btn c-btn--danger c-btn--small" @click="remove(product.id)">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="c-card__footer clearfix">
                        <router-link to="/admin/products/add" class="c-btn c-btn--primary float-right">Create New</router-link>
                    </div>
                </div>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                products: []
            }
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            async fetchData() {
                this.isHolding();

                await axios.get('/api/products')
                    .then(response => response.data)
                    .then(data => {
                        this.products = data;
                    })
                    .then(response => this.isHolding())
            },
            remove(id) {
                swal({
                        title: "Tem certeza?",
                        text: "Once deleted, you will not be able to recover this content!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            axios.delete('/api/products/delete/' + id)
                                .then(response => {
                                    // success alert
                                    swal('Sucesso!', response.data.message, 'success');
                                    this.fetchData();
                                })
                        } else {
                            swal.close();
                        }
                    });
            }
        }
    }
</script>

<style>

</style>