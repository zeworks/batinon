<template>
    <b-container fluid>
        <b-row>
            <b-col sm="3" offset="1">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">New Subscribers</span>
                        <span class="info-box-number">{{subscribers}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    export default {
        data() {
            return {
                subscribers: 2,
            }
        }
    }
</script>