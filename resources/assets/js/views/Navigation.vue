<template>
    <b-container fluid>
        <b-row>
            <b-col sm="6" offset-md="1" md="3">
                <h2 class="u-font-bold">Navigation</h2>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(nav,index) in navigation" :key="index" class="c-table__row">
                                    <td>{{nav.title}}</td>
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
    </b-container>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                navigation: [],
                navStatus: []
            }
        },
        mounted() {
            this.fetchNavigationTable();
        },
        methods: {
            fetchNavigationTable() {
                axios.get('/api/navigation')
                    .then(response => response.data)
                    .then(data => {
                        this.navigation = data.navigations;
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
        }
    }
</script>