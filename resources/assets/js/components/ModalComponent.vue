<template>
    <div>
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
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
        </transition>
    </div>
</template>

<script>
    export default {
        // props: ['modal'],
        // computed: {
        //     modal() {
        //         var modal = this.modal;
        //         return false;
        //     }
        // },
        data() {
            return {}
        },
        mounted() {
            document.body.addEventListener('keyup', e => {
                if (e.keyCode === 27) {
                    this.modal = false;
                }
            })
        }
    }
</script>

<style>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        max-width: 1000px;
        margin: 0px auto;
        background-color: #fff;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
        width: 100%;
        overflow: hidden;
    }

    @media (max-width: 768px) {
        .modal-container {
            min-width: 100%;
        }
    }

    .modal-header * {
        margin-top: 0;
        color: #333;
        font-size: 21px;
        text-transform: uppercase;
        font-weight: 700;
    }

    .modal-body {
        margin: 20px 0;
        max-height: 600px;
        overflow-y: auto;
        display: block;
    }

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>