<template>
    <el-form label-position="top" ref="form" :model="form"  class="d-flex">
        <el-form-item prop="logo" label="Логотип" style="margin-right: 20px">
            <el-upload
                action=""
                v-model="form.logo"
                class="avatar-uploader"
                :auto-upload="false"
                :show-file-list="false"
                :on-change="uploadImage"
            >
                <figure class="avatar" v-if="form.logo">
                    <img  :src="form.logo" >
                </figure>
                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
            </el-upload>
        </el-form-item>
        <div style="flex: 1">
            <div class="row">
                <el-form-item label="Название" :error="errors.get('title')">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>
                <div class="col-md-6">
                    <el-form-item label="Стоимость" :error="errors.get('price_ru')">
                        <el-input-number :step="100" v-model="form.price_ru"  :min="0" ></el-input-number>
                    </el-form-item>
                </div>
                <div class="col-md-6">
                    <el-form-item label="Стоимость для не РФ" :error="errors.get('price_not_ru')">
                        <el-input-number :step="100" v-model="form.price_not_ru"  :min="0" ></el-input-number>
                    </el-form-item>
                </div>
                <div class="col-md-6">
                    <el-form-item
                        :error="errors.get('api_id')"
                        label="Сервис проверки">
                        <el-select
                            v-model="form.api_id"
                            placeholder="Выберите сервис проверки">
                            <el-option
                                v-for="item in api_list"
                                :key="item.id"
                                :label="item.title"
                                :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </div>
            </div>
            <el-form-item label="Описание системы проверки">
                <el-input  :rows="5" type="textarea" v-model="form.description"></el-input>
            </el-form-item>
            <el-form-item label="Пример отчета">
                <upload-file @clearFile="clearFile"  :value="form.report_file" @fileUpload="fileUpload"></upload-file>
            </el-form-item>
            <h6>Настройки системы проверки</h6>
            <el-form-item label="Ограничение по количеству символов">
                <el-input-number :step="100" v-model="form.symbols_count"  :min="0" ></el-input-number>
            </el-form-item>

            <div class="mt-3">
                <el-button type="success" @click.prevent="saveSystem">
                    Сохранить
                </el-button>
                <el-button type="default" @click.prevent="canselEdit">
                    Отмена
                </el-button>
            </div>
        </div>


    </el-form>
</template>
<script>
import uploadFile from './upload.vue';
import { Errors } from  '@/common/js/services/errors.js';
    export default {
        components: {uploadFile},
        props:{

            actionUrl: {
                type:String,
                required:true,
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
            clearFile() {
                this.form.file = null;
                this.form.report_file = '';
            },
          fileUpload(file) {
              console.log(file)
              this.form.file = file;
              this.form.report_file = file.name;
            },
            canselEdit() {
                this.$emit('cancel');
            },
            saveSystem() {
                this.$root.isLoading =  true;
                const formData = new FormData();
                const headers = { 'Content-Type': 'multipart/form-data' };
                Object.keys(this.form).forEach((key) => {
                    formData.append(key, this.form[key]);
                })
                axios.post(this.actionUrl, formData, headers)
                    .then((response) => {
                        this.$root.isLoading = false;
                        this.$emit('save');

                    })
                    .catch((error) => {
                        this.$root.isLoading = false;
                        this.errors.record(error.response.data.errors);
                    })
            },
            getApiList() {
                axios.get('/api/admin/check-api/list')
                    .then((response) => {
                        this.api_list = response.data;
                        this.api_list.push({title:"Ручная", id:null})
                    })
            },
            uploadImage(file){
                let cond = this.beforeImageUpload(file.raw);
                console.log(cond);
                this.form['logoName'] = file.raw.name;
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
            this.getApiList();



        },

    }
</script>
