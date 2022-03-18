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
                <el-row type="flex" :gutter="10">
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
                <div class="text-center">
                    <el-button type="success" @click.prevent="save">Сохранить</el-button>
                    <el-button type="" @click.prevent="closeModal">Отменить</el-button>
                </div>
            </el-form>
        </el-tab-pane>
        <!-- <el-tab-pane label="Права доступа">

         </el-tab-pane>-->
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
            errors: new Errors(),
        }
    },
    methods: {
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
    }
}
</script>
