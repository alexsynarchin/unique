<template>
    <el-form :model="loginForm"  ref="loginForm" :rules="rules" >
        <el-form-item  prop="email" :error="errors.get('email')">
            <el-input
                size="large"
                placeholder="Введите e-mail"
                v-model="loginForm.email"
            ></el-input>
        </el-form-item>
        <el-form-item  prop="password" :error="errors.get('password')">
            <el-input
                size="large"
                placeholder="Введите пароль"
                v-model="loginForm.password" show-password
            />
        </el-form-item>
        <el-form-item class="text-center">
            <el-button type="primary" @click.prevent="loginPost()">Войти</el-button>
        </el-form-item>
    </el-form>
</template>
<script>
import { Errors } from  '@/common/js/services/errors.js';
export default {
    data() {

        return {
            loginForm:{
                email: '',
                password: '',

            },
            rules:{

            },
            errors: new Errors(),
        }
    },
    methods:{
        loginPost() {
            /*
            this.errors.clear();
            var _this = this;
            axios.post('/admin/handle-login', _this.loginForm)
                .then(function (response) {
                    window.location = response.data;
                })
                .catch(function (error) {
                    _this.errors.record(error.response.data.errors)
                })
                */

        }
    }

}
</script>
