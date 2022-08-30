<template>
    <el-form :model="form" label-position="top">
        <el-tabs type="card" v-model="activeTab">
            <el-tab-pane label="Основная информация" name="main">
                <div class="d-flex">
                    <el-form-item prop="logo" label="Превью" style="margin-right: 20px">
                        <el-upload
                            action=""
                            v-model="form.preview"
                            class="avatar-uploader"
                            :auto-upload="false"
                            :show-file-list="false"
                            :on-change="uploadImage"
                        >
                            <figure class="avatar" v-if="form.preview">
                                <img  :src="form.preview" >
                            </figure>
                            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                        </el-upload>
                    </el-form-item>
                    <div style="flex:1">
                        <el-form-item prop="title" label="Название" :error="errors.get('title')">
                            <el-input v-model="form.title"/>
                        </el-form-item>
                        <div class="row">
                            <el-form-item class="col-md-6" prop="date" label="Дата" :error="errors.get('date')">
                                <el-date-picker
                                    v-model="form.date"
                                    type="date"
                                    format="dd-MM-yyyy"
                                    value-format="yy-MM-dd"
                                    placeholder="Выберите дату">
                                </el-date-picker>
                            </el-form-item>
                            <el-form-item label="Опубликован" class="col-md-5"  prop="published">
                                <el-checkbox v-model="form.published">Опубликован</el-checkbox>
                            </el-form-item>
                        </div>
                        <el-form-item prop="text" label="Текст">
                            <richtext :value.sync ="form.content.text" v-if="form.content"></richtext>
                        </el-form-item>

                    </div>
                </div>
            </el-tab-pane>
        </el-tabs>
        <el-button type="success" @click.prevent="submitForm">Сохранить</el-button>
    </el-form>
</template>
<script>
import richtext from "../../../components/richtext/richtext";
import { Errors } from  '@/common/js/services/errors.js';
import Seo from '@/admin/js/components/seo/seo';
    export default {
        components: {
            'Seo':Seo,
            'richtext':richtext,
        },
        props: {
            saveMsg: {
                default: 'Статья сохранена'
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
                activeTab:'main',
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
                this.form.imageName = file.raw.name;
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
                    vm.form.preview = e.target.result;
                };
                reader.readAsDataURL(file.raw);
            },
        },
        mounted() {

        }
    }
</script>
