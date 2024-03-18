<template>
    <el-form ref="form" :model="form" label-position="top" class="mb-4">
        <h3>{{smtp_title}}</h3>
        <div class="row mb-3">
            <el-form-item class="col-lg-6" prop="email" label="email">
                <el-input v-model="form.email"></el-input>
            </el-form-item>
            <el-form-item class="col-lg-6" prop="password" label="Пароль приложений">
                <el-input v-model="form.password"></el-input>
            </el-form-item>
        </div>
        <div class="row mb-3">
            <el-form-item class="col-lg-4" prop="host" label="host">
                <el-input v-model="form.host"></el-input>
            </el-form-item>
            <el-form-item class="col-lg-4" prop="port" label="port">
                <el-input v-model="form.port"></el-input>
            </el-form-item>
            <el-form-item class="col-lg-4" prop="encryption" label="encryption">
                <el-input v-model="form.encryption"></el-input>
            </el-form-item>
        </div>
        <el-button type="success" @click="submitForm">Сохранить</el-button>
    </el-form>
</template>
<script>
export default  {
    props: {
        smtp_title:String,
        settings_group:String,
    },
    data(){
        return {
            form : {
                email: '',
                password: "",
                port: "",
                encryption:"",
                host: ""
            }
        }
    },
    methods: {
        submitForm() {
            for(var key in this.form) {
                axios.post('/api/admin/setting/update',{value:this.form[key], group:this.settings_group,name:key})
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
        getData() {
            axios.get('/api/admin/setting/get', {params: {group:this.settings_group}})
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
        this.getData()
    }
}

</script>
