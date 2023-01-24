<template>
    <el-form ref="form" :model="form" label-position="top" :rules="rules">
        <el-tabs type="card" v-model="activeTab">
            <el-tab-pane label="Основная информация" name="main">
                <div class="row">
                    <el-form-item prop="name" label="Заголовок"  class="col-md-7">
                        <el-input v-model="form.name"></el-input>
                    </el-form-item>
                    <el-form-item label="Опубликован" class="col-md-5"  prop="published" v-if="formAction != '/api/admin/static-page/store'">
                        <el-checkbox v-model="form.active">Опубликован</el-checkbox>
                    </el-form-item>
                </div>
                <div class="row">
                    <el-form-item prop="slug" label="URL"  class="col-md-7" :error="errors.get('slug')">
                        <el-input v-model="form.slug"></el-input>
                    </el-form-item>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <Editor
                            v-model="form.content.text"
                            api-key="n5vevbezoz59y0xm5lm9351k04wpcdlod46tt4h2ilw0x2er"
                            :init="{
                                height: 600,
        plugins: 'lists link image table code help wordcount',
        toolbar: 'undo redo styles bold italic alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table forecolor backcolor',
         language: 'ru',
         table_background_color_map: [
    { title: 'Gray', value: 'F0F1F6' },
    { title: 'Orange', value: 'FF9902' },
    { title: 'Blue', value: '366AF3' },
  ],
           color_map: [
    'F0F1F6', 'Gray',
    'FF9902', 'Orange',
    '366AF3', 'Blue'
  ]
      }"
                        />
                    </div>
                </div>
            </el-tab-pane>
            <el-tab-pane label="Настройки и SEO" name="config">
                <Seo :form = "form.seo" v-if="form.seo"></Seo>
            </el-tab-pane>
        </el-tabs>
        <div class="text-right mt-3">
            <el-button type="success" @click="submitForm('form')">Сохранить</el-button>
            <el-button @click="closeModal">Отмена</el-button>
        </div>
    </el-form>
</template>
<script>
import richtext from "../../../components/richtext/richtext";
import { Errors } from  '@/common/js/services/errors.js';
import Seo from '@/admin/js/components/seo/seo';
import Editor from '@tinymce/tinymce-vue'
export default {
    props:['form','formAction'],
    components: {
        'Seo':Seo,
        'richtext':richtext,
        Editor
    },
    data() {
        return {
            activeTab: 'main',
            rules: {
                name: [
                    { required: true, message: 'Введите название страницы', trigger: 'blur' },
                ],
            },
            buildings:[],
            errors: new Errors(),
        }
    },
    methods:{
        prepareForm() {
            if(this.form.type === 'about') {
                return this.form.blocks =  this.$refs.blocks.submitForm();
            }
            if(this.form.type === 'contest') {
                return this.form.blocks =  this.$refs.contest.submitForm();
            }

        },
        async submitForm(formName) {
            if(this.form.type === 'about' || this.form.type === 'contest') {
                await this.prepareForm();
                console.log(this.form.blocks)
            }
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.$root.isLoading = true;
                    axios({
                        method: this.formAction.method ,
                        url: this.formAction.url,
                        data: this.form
                    })
                        .then((response) => {
                            this.$root.isLoading = false;
                            this.$emit('closeModal','submit')
                        })
                        .catch((error) => {
                            this.$root.isLoading = false;
                            this.errors.record(error.response.data.errors)
                        })
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        closeModal() {
            this.$emit('closeModal','close')
        },

    },
    mounted() {

    }
}
</script>
<style >
.preview-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}
.preview-uploader .el-upload:hover {
    border-color: #409EFF;
}
.preview-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 280px;
    height: 280px;
    line-height: 280px;
    text-align: center;
}
.preview {
    width: 280px;
    height: 280px;
    display: block;
}
.ck-editor__editable {
    min-height: 200px;
}
</style>
