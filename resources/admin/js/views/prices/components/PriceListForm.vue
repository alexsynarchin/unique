<template>
    <el-form :model="form" ref="form" label-position="top" :rules="rules">
        <div class="d-flex">
            <el-form-item prop="image" style="margin-bottom: 0; margin-right: 20px" label="Логотип">
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
            <div style="flex: 1">
                <el-form-item label="Заголовок"  prop="title">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>
                <el-form-item label="Стоимость">
                    <el-input-number v-model="form.price"  :min="0" ></el-input-number>
                </el-form-item>
                <el-form-item label="Текст">
                    <el-input type="textarea" v-model="form.description"></el-input>
                </el-form-item>
            </div>
        </div>
        <el-button  type="success" @click="submitForm('form')">Сохранить элемент</el-button>
    </el-form>
</template>
<script>
    export default {
        props: {
            id: {},
            index: {},
            action_type: {
                type:String
            },
            action_url: {
                type:String
            },
            form: {
                type:Object,
            },
        },
        data() {
            return {
                rules: {
                    title: [
                        {required:true, message: "Заполните заголовок"}
                    ]
                },
            }
        },
        methods: {
            submitForm(formName) {

                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.form.index = this.index;
                        axios({
                            method: this.action_type,
                            url: this.action_url,
                            data: this.form
                        })
                            .then((response) => {
                                this.$emit('submit', response.data);
                            })
                            .catch((error) => {

                            })

                    } else {
                        console.log('eeee');
                        return false;
                    }
                });
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
        }
    }
</script>
