<template>
    <section>
        <h3 class="block-title">
            Общие Настройки
        </h3>
        <el-form ref="form" :model="form" label-position="top">
            <div class="row">
                <el-form-item class="col-lg-6" prop="phone_header" label="Телефон в шапке сайта">
                    <el-input v-model="form.phone_header"></el-input>
                </el-form-item>
                <el-form-item class="col-lg-6" prop="phone_footer" label="Телефон в подвале сайта">
                    <el-input v-model="form.phone_footer"></el-input>
                </el-form-item>
                <el-form-item class="col-lg-6" prop="email" label="E-mail">
                    <el-input v-model="form.email"></el-input>
                </el-form-item>
                <el-form-item class="col-lg-6" prop="faq_link" label="Копирайт в подвале сайта">
                    <el-input v-model="form.copyright"></el-input>
                </el-form-item>
            </div>
            <h4>Социальные сети</h4>
            <div class="row">
                <el-form-item class="col-lg-6" prop="instagram_link" label="Ссылка instagram">
                    <el-input v-model="form.instagram_link"></el-input>
                </el-form-item>
                <el-form-item class="col-lg-6" prop="facebook_link" label="Ссылка facebook">
                    <el-input v-model="form.facebook_link"></el-input>
                </el-form-item>
                <el-form-item class="col-lg-6" prop="vk_link" label="Ссылка vkontakte">
                    <el-input v-model="form.vk_link"></el-input>
                </el-form-item>
            </div>
            <el-button type="success" @click="submitForm">Сохранить</el-button>
        </el-form>
    </section>
</template>
<script>
    export default {
        data() {
          return {
              form:{
                  phone_header: "",
                  phone_footer:"",
                  copyright:"",
                  email:"",
                  instagram_link:"",
                  facebook_link:"",
                  vk_link:"",
              }
          }
        },
        methods: {
            submitForm() {
                for(var key in this.form) {
                    axios.post('/api/admin/setting/common-update',{value:this.form[key], group:'common',name:key})
                        .then((response) => {

                        })
                        .catch((error)=>{
                            console.log(error);
                        });
                }
                this.$notify({
                    title: 'Основные настройки сохранены',
                    type: 'success'
                });
            },
            getData() {
                axios.get('/api/admin/setting/common/get')
                    .then((response) => {
                        var data = response.data;
                        for (var key in data) {
                            if(key in this.form){
                                this.form[key] = data[key];
                            }
                        }
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            }
        },
        mounted() {
            this.getData();
        },
    }
</script>
