<template>
    <div class="modal-mask">
        <div class="modal-wrapper" :class="{ 'modal-wrapper--small' : this.small} ">
            <div class="modal-container">

                <div class="modal-header">
                    <slot name="header">
                        <!-- default header -->
                    </slot>
                </div>

                <div class="modal-body">
                    <slot name="body">
                        <!-- default body -->
                    </slot>
                </div>

                <div class="modal-footer">
                    <slot name="footer">
                        <!-- default footer -->
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            small: Boolean
        },
        data() {
            return {}
        }
    }
</script>