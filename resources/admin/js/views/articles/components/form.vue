<template>
    <el-form :model="form">
        <el-form-item prop="title" label="Название" :error="errors.get('title')">
            <el-input v-model="form.title"/>
        </el-form-item>
        <el-form-item prop="price" label="Стоимость">
            <el-input-number :min="0" v-model="form.price"/>
        </el-form-item>
        <el-form-item prop="description" label="Описание">
            <el-input type="textarea" v-model="form.description" rows="6"></el-input>
        </el-form-item>
        <el-button type="success" @click.prevent="submitForm">Сохранить</el-button>
    </el-form>
</template>
<script>
import { Errors } from  '@/common/js/services/errors.js';
    export default {
        props: {
            saveMsg: {
                default: 'Услуга добавлена'
            },
            form: {
                type:Object,
            },
            formAction: {
                type:Object
            },
        },
        data() {
            return {
                errors: new Errors(),
            }
        },
        methods: {
            submitForm() {
                axios({
                    method: this.formAction.method ,
                    url: this.formAction.url,
                    data: this.form
                }).then((response) => {
                    this.$message({
                        message: this.saveMsg,
                        type: 'success'
                    });
                    this.$emit('submit', response.data);
                })
                    .catch((error) => {
                        this.errors.record(error.response.data.errors);
                    })
                ;

            },
            uploadImage(file){
                let cond = this.beforeImageUpload(file.raw);
                this.form.logoName = file.raw.name;
                console.log(cond);

                if(cond){
                    this.createImage(file);
                }
            },

            beforeImageUpload(file) {
                const isJPG = file.type === 'image/jpeg';
                const isPNG = file.type === 'image/png';
                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPG && !isPNG) {
                    this.$message.error('Картинка должна быть в формате jpeg или png');
                }
                if (!isLt2M) {
                    this.$message.error('Размер не может превышать 2МБ');
                }
                return (isJPG || isPNG) && isLt2M;
            },

            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.form.logo = e.target.result;
                };
                reader.readAsDataURL(file.raw);
            },
        },
        mounted() {

        }
    }
</script>
