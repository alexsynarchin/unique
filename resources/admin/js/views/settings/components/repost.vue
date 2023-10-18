<template>
    <section>
        <h3 class="block-title">
            Настройки для репоста
        </h3>
        <el-form label-position="top">
            <el-form-item class="col-lg-6" prop="image"  label="Картинка" >
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
          <el-form-item class="col-lg-6" prop="title" label="Заголовок для репоста">
            <el-input v-model="form.title"></el-input>
          </el-form-item>
            <el-form-item class="col-lg-6" prop="repost_text" label="Текст для репоста">
                <el-input
                    type="textarea"
                    :autosize="{ minRows: 2, maxRows: 4}"
                    placeholder=""
                    v-model="form.repost_text">
                </el-input>
            </el-form-item>
            <el-button type="success" @click="submitForm">Сохранить</el-button>
        </el-form>


    </section>
</template>
<script>
    export default {
        data() {
            return {
                form: {
                    repost_text: "",
                    title: "",
                    image: {
                        link: "",
                    }
                }
            }
        },
        methods: {
            getData() {
                axios.get('/api/admin/setting/get', {params: {group:'repost'}})
                    .then((response) => {
                        var data = response.data;
                        for (var key in data) {
                            if(key in this.form){
                                if(key === 'image') {
                                    this.form[key]['link'] = data[key];
                                } else {
                                    this.form[key] = data[key];
                                }

                            }
                        }
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },
            submitForm() {
                for(var key in this.form) {
                    axios.post('/api/admin/setting/update',{value:this.form[key], group:'repost',name:key})
                        .then((response) => {

                        })
                        .catch((error)=>{
                            console.log(error);
                        });
                }
                this.$notify({
                    title: 'Настройки сохранены',
                    type: 'success'
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

                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPG) {
                    this.$message.error('Картинка должна быть в формате jpeg');
                }
                if (!isLt2M) {
                    this.$message.error('Размер не может превышать 2МБ');
                }
                return isJPG  && isLt2M;
            },

            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.form.image.link = e.target.result;
                };
                reader.readAsDataURL(file.raw);
            },
        },
      mounted() {
          this.getData();
      }
    }
</script>
