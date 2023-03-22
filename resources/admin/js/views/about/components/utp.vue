<template>
    <section class="page-block">
        <el-form ref="form" label-position="top">
            <div class="d-flex">
                <el-form-item prop="image" style="margin-bottom: 0; margin-right: 20px" label="Картинка">
                    <el-upload
                        action=""
                        v-model="form.image.link"
                        class="avatar-uploader"
                        :auto-upload="false"
                        :show-file-list="false"
                        :on-change="uploadImage"
                    >
                        <img v-if="form.image.link" :src="form.image.link" class="avatar">
                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                    </el-upload>
                </el-form-item>
                <div style="flex:1;">
                    <div class="row">
                        <el-form-item label="Заголовок" class="col-md-6">
                            <el-input v-model="form.title"></el-input>
                        </el-form-item>
                    </div>

                    <el-form-item label="Описание">
                        <tinymce v-if="form.description" v-model="form.description"/>
                    </el-form-item>
                </div>
            </div>
            <div class="mt-3">
                <el-button type="success" @click.prevent = "submitForm">Сохранить</el-button>
            </div>
        </el-form>
    </section>
</template>
<script>
import Tinymce from '@/admin/js/components/TinymceSmall';
    export default {
        components: {
            Tinymce
        },
        data() {
            return {
                block: {},
                type: 'about-utp',
                form: {
                    title: "",
                    description: "",
                    image: {
                        link: "",
                    }
                }
            }
        },
        methods: {
            submitForm() {
                axios.put('/api/admin/content-block/' + this.block.id + '/update', this.form)
                    .then((response) => {
                        this.$notify({
                            title: 'Блок сохранен',
                            type: 'success'
                        });
                    })
                    .catch((error) => {

                    })
            },
            uploadImage(file){
                let cond = this.beforeImageUpload(file.raw);
                this.form.image['imageName'] = file.raw.name;
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
                    vm.form.image.link = e.target.result;
                };
                reader.readAsDataURL(file.raw);
            },
            getBlock() {
                axios.get('/api/admin/content-block/' + this.type)
                    .then((response) => {
                        this.block = response.data;
                        for (var key in this.form) {
                            console.log(key);
                            if(this.block.content[key]) {
                                this.form[key] = this.block.content[key];
                            }
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            }
        },
        async mounted() {
            await this.getBlock();
        },
    }
</script>
