<template>
    <el-tabs type="card" >
        <el-tab-pane label="Основная информация">
            <el-form :model="form" ref="form">
                <el-row type="flex" :gutter="10">
                    <el-col :span="12">
                        <el-form-item prop="email" label="E-mail" :error="errors.get('email')">
                            <el-input v-model="form.email" placeholder="Электронная почта"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="name" label="Имя"  :error="errors.get('name')">
                            <el-input v-model="form.name" placeholder="Имя"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row type="flex" :gutter="10">
                    <el-col :span="12">
                        <el-form-item prop="surname" label="Фамилия">
                            <el-input v-model="form.surname" placeholder="Фамилия"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="last_name" label="Отчество">
                            <el-input v-model="form.last_name" placeholder="Отчество"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row type="flex" :gutter="10" v-if="formAction.method === 'post'">
                    <el-col :span="12">
                        <el-form-item prop="password" label="Пароль" :error="errors.get('password')">
                            <el-input v-model="form.password" placeholder="Введите пароль" show-password></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="password_confirmation" label="Подтверждение пароля">
                            <el-input v-model="form.password_confirmation" placeholder="Повторите пароль" show-password></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row type="flex" :gutter="10" v-else>
                    <el-col :span="12">
                        <el-button icon="el-icon-unlock" type="primary" @click="showPasswordModal = true">Сменить пароль</el-button>
                    </el-col>
                </el-row>
                <div class="text-center">
                    <el-button type="success" @click.prevent="save">Сохранить</el-button>
                    <el-button type="" @click.prevent="closeModal">Отменить</el-button>
                </div>
            </el-form>
            <el-dialog
                append-to-body
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
        </el-tab-pane>
        <el-tab-pane label="Права доступа">
            <el-checkbox-group v-model="form.permissions_arr" @change="">
                <div class="row">
                    <div class="col-md-6 mb-2" v-for="permission in permissions" v-if="permission.name !=='manage_permission'">
                        <el-checkbox    :label="permission.name" :key="permission.name">{{$t('permissions.' + permission.name)}}</el-checkbox>
                    </div>

                </div>

            </el-checkbox-group>
         </el-tab-pane>
    </el-tabs>
</template>
<script>
import { Errors } from  '@/common/js/services/errors.js';
export default {
    props:{
        saveMsg: {
            default: 'Модератор добавлен'
        },
        form: {
            type:Object
        },
        formAction: {
            type:Object
        }
    },
    data() {
        return {
            showPasswordModal:false,
            passwordForm: {
                password: '',
                password_confirmation: ''
            },
            permissions: [],
            errors: new Errors(),
        }
    },
    methods: {
        changePassword() {
            axios.post('/api/admin/user/' + this.form.id + '/change-password', this.passwordForm)
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
        getPermissions() {
            axios.get('/api/admin/permissions')
                .then((response) => {
                    this.permissions = response.data;
                })
        },
        closeModal(data) {
            this.$emit('close', data);
        },
        save() {
            axios({
                method: this.formAction.method ,
                url: this.formAction.url,
                data: this.form
            }).then((response) => {
                this.$message({
                    message: this.saveMsg,
                    type: 'success'
                });
                this.closeModal();
            })
                .catch((error) => {
                    this.errors.record(error.response.data.errors);
                })
            ;

        },
    },
    mounted() {
        this.getPermissions();
    }
}
</script>
