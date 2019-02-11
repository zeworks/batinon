<template>
    <b-container>
        <form @submit.prevent="saveProfile">
            <!-- profile page -->
            <b-row>
                <b-col md="3" class="text-center">
                    <!-- ::picture component -->
                    <div class="c-picture c-picture--shadow c-picture--circle">
                        <div class="c-picture__image--bg" :style="{ 'background-image' : 'url(' + (userImageBase64 ? userImageBase64 : origin + image_path + userImage) + ')'}"></div>
                        <!-- hidden input -->
                        <input type="file" id="picture" class="hidden" @change="changePicture($event)">
                        <button type="button" class="c-picture__change" @click="fileClick"><i class="fas fa-camera c-picture__icon"></i></button>
                    </div>
                    <span class="u-color-grey-light">[2MB Max]</span>
                    <!-- ::picture component -->
                </b-col>
                <b-col md="9">
                    <b-row class="clearfix">
                        <b-col md="6">
                            <h4 class="u-font-medium u-text-transform-uppercase">Update your Profile</h4>
                            <span>Here you can update your personal details!</span>
                        </b-col>
                        <b-col md="6">
                            <button type="button" class="c-btn c-btn--primary float-right" @click="showModal = true">Change
                                Password</button>
                        </b-col>
                    </b-row>
                    <br>
                    <br>
                    <div class="c-form">
                        <label for="name" class="c-form__label">Name</label>
                        <input type="text" id="name" class="c-form__input" v-model="userName">
                    </div>
                    <div class="c-form">
                        <label for="email" class="c-form__label">Email</label>
                        <input type="text" id="email" class="c-form__input" v-model="userEmail">
                    </div>
                    <br>
                    <button type="submit" class="c-btn c-btn--primary">Save</button>
                </b-col>
            </b-row>
            <!-- end profile page -->
        </form>
        <!-- ::modal to change password -->
        <v-modal small v-if="showModal">
            <h3 slot="header" class="f-subtitle">Change your password</h3>
            <div slot="body">
                <div class="c-form" v-if="!nextStep">
                    <label for="atualPassword" class="c-form__label">Actual Password</label>
                    <input type="password" id="atualPassword" class="c-form__input" v-focus v-model="actualPassword"
                        @keydown.enter="validateActualPassword">
                    <small class="u-color-error" v-if="error">{{errorMessage}}</small>
                </div>
                <div class="c-form" v-if="nextStep">
                    <label for="newPassword" class="c-form__label">New Password</label>
                    <input type="password" id="newPassword" class="c-form__input" v-focus v-model="newPassword"
                        @keydown.enter="validateNewPassword">
                    <small class="u-color-error" v-if="error">{{errorMessage}}</small>
                </div>
            </div>
            <div slot="footer">
                <div class="clearfix"></div>
                <div class="float-right">
                    <button type="button" @click="closeModal" class="c-btn c-btn--text">Cancel</button>
                    <button type="button" v-if="!nextStep" @click="validateActualPassword" class="c-btn c-btn--primary">Next</button>
                    <button type="button" v-else @click="validateNewPassword" class="c-btn c-btn--primary">Update</button>
                </div>
            </div>
        </v-modal>
        <!-- ::modal to change password -->
    </b-container>
</template>

<script>
    import axios from 'axios'
    export default {
        data() {
            return {
                userImage: '',
                userImageBase64: '',
                userName: '',
                userEmail: '',
                actualPassword: '',
                newPassword: '',
                error: false,
                errorMessage: '',
                nextStep: false,
                imageChanged: false
            }
        },
        mounted() {
            this.getProfile()
        },
        methods: {
            getProfile() {
                this.isLoading()
                var req = axios.get('/api/user/' + window.user)
                    .then(response => response.data)
                    .then(data => {
                        this.userName = data.data[0].name;
                        this.userEmail = data.data[0].email;
                        this.userImage = data.data[0].image;
                    });
                req.then(response => this.isLoading());
            },
            validateActualPassword() {
                axios.post('/api/user/password', {
                        id: window.user,
                        password: this.actualPassword
                    }).then(response => response.data)
                    .then(data => {
                        if (data.success) {
                            this.error = false
                            this.nextStep = true
                        } else {
                            this.error = true
                            this.errorMessage = data.message
                        }
                    })
            },
            validateNewPassword() {
                axios.put('/api/user/password', {
                        id: window.user,
                        password: this.newPassword
                    }).then(response => response.data)
                    .then(data => {
                        if (data.success) {
                            this.closeModal()
                            swal('Success!', data.message, 'success');
                            // message to refresh the session
                            swal('You must loggout to refresh the details!', {
                                    buttons: {
                                        accept: {
                                            text: 'Ok, logout!',
                                            value: 'accept'
                                        }
                                    }
                                })
                                .then((value) => {
                                    if (value) {
                                        window.location.href = "/login"
                                    }
                                })
                        } else {
                            this.error = true
                            this.errorMessage = data.message
                        }
                    })
            },
            saveProfile() {
                this.sendImage()
                
                axios.put('/api/user', {
                    id: window.user,
                    name: this.userName,
                    email: this.userEmail,
                    image: this.userImage.name
                }).then(response => response.data)
                    .then(data => {
                        if (data.success) {
                            swal('Success!', data.message, 'success');
                        } else {
                            swal('Error!', data.message, 'error');
                        }
                    })
            },
            sendImage() {
                if (this.userImageBase64) {
                    const formData = new FormData();
                    formData.append('image', this.userImage);

                    axios.post('/api/files/add', formData)
                        .then(response => {
                        }).catch(function () {
                            swal('Erro!', response.data.message, 'error');
                        });
                }
            },
            closeModal() {
                this.showModal = false
                this.nextStep = false
                this.actualPassword = ''
                this.newPassword = ''
            },
            fileClick() {
                $('#picture').click();
            },
            changePicture(event) {
                this.userImage = event.target.files[0];
                this.userImageBase64 = event.target.files[0];
                this.imageChanged = true;

                var reader = new FileReader();
                var _this = this
                reader.onloadend = function () {
                    _this.userImageBase64 = reader.result;

                }
                reader.readAsDataURL(this.userImageBase64);
            },
        }
    }
</script>