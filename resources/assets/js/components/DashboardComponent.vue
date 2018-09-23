<template>
    <div>
        <div class="row">
            <div class="col-sm-3">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">New Subscribers</span>
                    <span class="info-box-number">{{subscribers}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>
    </div>
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