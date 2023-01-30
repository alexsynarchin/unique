<template>
    <el-form label-position="top" ref="form" :model="form">
            <div class="row">
                <div class="col-md-4">
                    <el-form-item label="E-mail" :error="errors.get('email')">
                        <el-input v-model="form.email"></el-input>
                    </el-form-item>
                </div>

                <div class="col-md-4">
                    <el-form-item label="userkey/API_KEY" :error="errors.get('key')">
                        <el-input  v-model="form.key"></el-input>
                    </el-form-item>
                </div>
                <div class="col-md-4">
                    <el-form-item label="Пароль" :error="errors.get('password')">
                        <el-input  v-model="form.password"></el-input>
                    </el-form-item>
                </div>
            </div>
            <div class="mt-3">
                <el-button type="success" @click.prevent="saveSystem">
                    Сохранить
                </el-button>
                <el-button type="default" @click.prevent="canselEdit">
                    Отмена
                </el-button>
            </div>
    </el-form>
</template>
<script>
import { Errors } from  '@/common/js/services/errors.js';
    export default {
        props:{

            formAction: {
                type:Object
            },
            form: {
                type:Object,
                required:true,
            }
        },
        data() {
            return {
                api_list: [],
                errors: new Errors(),
            }
        },
        methods: {
            canselEdit() {
                this.$emit('cancel');
            },
            saveSystem() {
                this.$root.isLoading =  true;
                axios({
                    method: this.formAction.method ,
                    url: this.formAction.url,
                    data: this.form
                })
                  .then((response) => {
                        this.$root.isLoading = false;
                        this.$emit('save');

                    })
                    .catch((error) => {
                        this.$root.isLoading = false;
                        this.errors.record(error.response.data.errors);
                    })
            },



        },
        mounted() {

        }
    }
</script>
