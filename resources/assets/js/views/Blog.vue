<template>
    <b-container fluid>
        <div class="c-card">
            <div class="c-card__body">
                <table class="c-table no-margin">
                    <thead class="c-table__header">
                        <tr>
                            <th>ID</th>
                            <th>Blog Title</th>
                            <th>Blog Slug</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="this.$root.placeholders && blogs.length === 0">
                            <td colspan="5">
                                <v-placeholder />
                            </td>
                        </tr>
                        <tr v-if="!this.$root.placeholders && blogs.length === 0">
                            <td colspan="5">
                                <div class="text-center">
                                    <br>
                                    <p>You have no blogs created yet!</p>
                                </div>
                            </td>
                        </tr>
                        <tr v-else class="c-table__row" v-for="(blog,index) in blogs" :key="index">
                            <td>
                                #{{blog.id}}
                            </td>
                            <td>
                                <router-link :to="'/admin/blog/edit/'+blog.id">{{blog.b_title}}</router-link>
                            </td>
                            <td>{{blog.slug}}</td>
                            <td>
                                <div class="u-tag" :class="{'u-tag--success' : blog.status == '1', 'u-tag--danger' : blog.status == '0'}">
                                    <span v-if="blog.status == 1">
                                        Active
                                    </span>
                                    <span v-if="blog.status == 0">
                                        Inactive
                                    </span>
                                </div>
                            </td>
                            <td>{{blog.created_at}}</td>
                            <td>
                                <div class="float-right">
                                    <router-link :to="'/admin/blog/edit/'+blog.id" class="c-btn c-btn--text c-btn--small">Edit</router-link>
                                    <button class="c-btn c-btn--danger c-btn--small" @click="remove(blog.id)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="c-card__footer clearfix">
                <router-link to="/admin/blog/add" class="c-btn c-btn--primary float-right">Create New</router-link>
            </div>
        </div>
    </b-container>

</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                blogs: [],
            }
        },
        created() {
            this.fetchBlogs();
        },
        methods: {
            fetchBlogs() {
                this.isHolding();
                var req = axios.get('/api/blogs')
                    .then(response => response.data)
                    .then(data => {
                        this.blogs = data;
                    });
                req.then(response => this.isHolding())
            },
            remove(id) {
                swal({
                        title: "Tem certeza?",
                        text: "Once deleted, you will not be able to recover this item!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            axios.delete('/api/blogs/delete/' + id)
                                .then(response => {
                                    // success alert
                                    swal('Sucesso!', 'Blog post Deleted', 'success');
                                    this.fetchBlogs();
                                })
                        } else {
                            swal.close();
                        }
                    });
            },
        }
    }
</script>