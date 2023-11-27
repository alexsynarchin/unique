<template>
    <section>
        <h3 class="block-title">
            Общие Настройки
        </h3>
    {{form}}
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
                <el-form-item class="col-lg-6" prop="email_admin" label="E-mail для оповещений">
                    <el-input v-model="form.email_admin"></el-input>
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
                <el-form-item class="col-lg-6" prop="facebook_link" label="Ссылка whatsapp">
                    <el-input v-model="form.whatsapp_link"></el-input>
                </el-form-item>
                <el-form-item class="col-lg-6" prop="vk_link" label="Ссылка vkontakte">
                    <el-input v-model="form.vk_link"></el-input>
                </el-form-item>
            </div>
            <div class="row">
                <el-form-item class="col-lg-6" prop="free_email_send" label="Отправлять email при бесплатной проверке">
                    <el-switch v-model="form.free_email_send">
                    </el-switch>

                </el-form-item>
                <el-form-item class="col-lg-6" prop="recaptcha" label="Google recaptcha v3">
                    <el-switch v-model="form.recaptcha">
                    </el-switch>

                </el-form-item>
            </div>
            <div class="row">
                <el-form-item class="col-lg-6" prop="free_email_send" label="Разрешить бесплатную проверку">
                    <el-switch v-model="form.free_check">
                    </el-switch>

                </el-form-item>
                <el-form-item class="col-lg-6" prop="free_email_send" label="Отправлять письмо о выставлении счета">
                    <el-switch v-model="form.need_payment">
                    </el-switch>

                </el-form-item>
            </div>
            <div class="mb-3">
                <el-input type="textarea" :rows="12" v-model="form.scripts"></el-input>
            </div>
            <el-button type="success" @click="submitForm">Сохранить</el-button>
        </el-form>

       <!-- <favicon-upload></favicon-upload>-->
    </section>
</template>
<script>
    import FaviconUpload from "./FaviconUpload";
    export default {
        components: {
            FaviconUpload
        },
        data() {
          return {
              form:{
                  phone_header: "",
                  phone_footer:"",
                  copyright:"",
                  email:"",
                  email_admin:"",
                  instagram_link:"",
                  whatsapp_link:"",
                  vk_link:"",
                  favicon: "",
                  scripts: "",
                  free_email_send: false,
                  recaptcha: false,
                  free_check:false,
                  need_payment:false,
              }
          }
        },
        methods: {
            submitForm() {
                for(var key in this.form) {
                    axios.post('/api/admin/setting/update',{value:this.form[key], group:'common',name:key})
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
                axios.get('/api/admin/setting/get', {params: {group:'common'}})
                    .then((response) => {
                        var data = response.data;
                        for (var key in data) {
                            if(key in this.form){
                                this.form[key] = data[key];
                                if (key === 'free_email_send' || key === 'need_payment' || key === 'recaptcha' || key === 'free_check') {
                                    if(this.form[key] === 'true') {
                                        this.form[key] = true;
                                    }  else {
                                        this.form[key] = false;
                                    }
                                }
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
