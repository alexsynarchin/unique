<template>
    <section>
        <h1>Профиль пользователя</h1>
        <el-card class="box-card col-md-6">
            <div slot="header" class="clearfix">
                <span>Основная информация</span>
               <!-- <el-button style="float: right; padding: 3px 0" type="text">Сменить пароль</el-button>-->
            </div>
            <el-form type="" :model="form" label-position="top">
                <el-form-item label="Имя" :error="errors.get('name')">
                    <el-input v-model="form.name"></el-input>
                </el-form-item>
                <el-form-item label="E-mail" :error="errors.get('email')">
                    <el-input v-model="form.email"></el-input>
                </el-form-item>
                <div class="col-md-6" style="margin-bottom: 22px;">
                    <el-button icon="el-icon-unlock" type="primary" @click="showPasswordModal = true">Сменить пароль</el-button>
                </div>
                <el-button type="primary" @click="onSubmit">Сохранить</el-button>
            </el-form>
        </el-card>
        <el-dialog
            :visible.sync="showPasswordModal"
            title="Сменить пароль"
        >
            <el-form :model="passwordForm" label-position="top">
                <div class="row">
                    <el-form-item class="col-md-6" label="Новый пароль" :error="errors.get('password')">
                        <el-input v-model="passwordForm.password" show-password></el-input>
                    </el-form-item>
                    <el-form-item class="col-md-6" label="Подтверждение пароля">
                        <el-input v-model="passwordForm.password_confirmation" show-password></el-input>
                    </el-form-item>
                </div>
            </el-form>
            <span slot="footer" class="dialog-footer">
            <el-button @click="showPasswordModal = false">Отмена</el-button>
            <el-button type="success" @click="changePassword">Сохранить</el-button>
          </span>
        </el-dialog>
    </section>
</template>
<script>
import { mapGetters } from 'vuex';
import { Errors } from  '@/common/js/services/errors.js';
    export default {
        data() {
            return {
                showPasswordModal:false,
                passwordForm: {
                    password: '',
                    password_confirmation: ''
                },
                form: {
                    name: "",
                    email: ""
                },
                errors: new Errors(),
            }
        },
        computed: {
            ...mapGetters([
                'userId',
            ]),
        },
        methods: {
            changePassword() {
                axios.post('/api/admin/user/' + this.userId + '/change-password', this.passwordForm)
                    .then((response) => {
                        this.$message({
                            message: response.data,
                            type: 'success'
                        });
                        this.showPasswordModal = false;
                        this.passwordForm.password = '';
                        this.passwordForm.password_confirmation= '';
                    })
                    .catch((error) => {
                        this.errors.record(error.response.data.errors);
                    })
            },
            onSubmit() {
                axios.post('/api/admin/user/' + this.userId + '/update', this.form)
                    .then((response) => {
                        console.log(response.data)
                    })
                    .catch((error) => {
                        this.errors.record(error.response.data.errors);
                    })
            },
            getUser() {
               axios.get('/api/admin/user/' + this.userId + '/profile')
                   .then((response) => {
                       this.form = response.data;
                   })
            },
        },
        mounted() {
            this.getUser();
        }
    }
</script>
