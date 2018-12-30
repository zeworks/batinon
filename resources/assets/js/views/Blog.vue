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
                    <tbody v-if="blogs[0] != null">
                        <tr class="c-table__row" v-for="(blog,index) in blogs" :key="index">
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
                                    <router-link :to="'/admin/blog/edit/'+blog.id" class="c-btn c-btn--primary c-btn--small">Edit</router-link>
                                    <button class="c-btn c-btn--link" @click="remove(blog.id)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="5">
                                <div class="text-center">
                                    <br>
                                    <p>You have no blogs created yet!</p>
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
                axios.get('/api/blogs')
                    .then(response => response.data)
                    .then(data => {
                        this.blogs = data;
                    });
            },
            remove(id) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this item!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            axios.post('/api/blogs/delete', {
                                    data: id
                                })
                                .then(response => {
                                    // success alert
                                    swal('Success!', 'Blog post Deleted', 'success');
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