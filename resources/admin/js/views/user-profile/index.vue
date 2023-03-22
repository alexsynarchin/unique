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
                <el-button type="primary" @click="onSubmit">Сохранить</el-button>
            </el-form>
        </el-card>

    </section>
</template>
<script>
import { mapGetters } from 'vuex';
import { Errors } from  '@/common/js/services/errors.js';
    export default {
        data() {
            return {
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
