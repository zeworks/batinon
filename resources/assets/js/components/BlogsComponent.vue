<template>
    <div>
        <div class="box box-success">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
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
                            <tr v-for="(blog,index) in blogs" :key="index">
                                <td>
                                    #{{blog.id}}
                                </td>
                                <td><a :href="('./blogs/edit/'+blog.id)">{{blog.title}}</a></td>
                                <td>{{blog.slug}}</td>
                                <td>
                                    <span class="label" :class="{'label-success' : blog.status == '1', 'label-danger' : blog.status == '0'}">
                                        <span v-if="blog.status == 1">
                                            Active
                                        </span>
                                        <span v-if="blog.status == 0">
                                            Inactive
                                        </span>
                                    </span>
                                </td>
                                <td>{{blog.created_at}}</td>
                                <td>
                                    <div class="pull-right">
                                        <a :href="('./blogs/edit/'+blog.id)" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-danger" @click="openModalDelete(blog.id)"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="5">
                                    <div class="text-center">
                                        <small>You have no blogs created yet!</small>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer clearfix">
                <a :href="('./blogs/new')" class="btn btn-sm btn-success btn-flat pull-right">Create New</a>
            </div>
        </div>
        <!-- modal remove Blog -->
        <modal v-if="showModalRemove" :removeid="removeId">
            <h3 slot="header">Delete blog</h3>
            <div slot="body" class="text-center">
                <h3>Do you really want to delete this blog?</h3>
            </div>
            <div slot="footer">
                <div class="clearfix"></div>
                <div class="pull-right">
                    <button @click="removeBlog" class="btn btn-success">Yes</button>
                    <button @click="showModalRemove = false" class="btn btn-default">No</button>
                </div>
            </div>
        </modal>
        <!-- \modal remove Blog -->
    </div>
</template>

<script>
    import modal from './ModalComponent.vue';

    export default {
        data(){
            return {
                blogs:[],
                removeId: 0,
                showModalRemove: false,
            }
        },
        components:{
            modal
        },
        created(){
            this.fetchBlogs();
        },
        methods:{
            fetchBlogs(){
                 axios.get('/api/blogs')
                .then( response => response.data)
                .then( data => {
                    this.blogs = data;
                });
            }
        }
    }
</script>