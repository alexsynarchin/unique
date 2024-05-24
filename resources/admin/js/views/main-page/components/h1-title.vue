<template>
    <section class="page-block">
        <el-form ref="form" label-position="top">
            <el-form-item label="Заголовок H1">
                <el-input v-model="form.h1"></el-input>
            </el-form-item>
            <el-form-item label="Описание заголовока H1">
                <el-input v-model="form.h1_description"></el-input>
            </el-form-item>
            <div class="mt-3">
                <el-button type="success" @click.prevent = "submitForm">Сохранить</el-button>
            </div>
        </el-form>
    </section>
</template>
<script>
export default {
    data() {
        return {
            form: {
                h1: "",
                h1_description: "",
            }
        }
    },
    methods: {
        submitForm() {
            for(var key in this.form) {
                axios.post('/api/admin/setting/update',{value:this.form[key], group:'main-page',name:key})
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
            axios.get('/api/admin/setting/get', {params: {group:'main-page'}})
                .then((response) => {
                    var data = response.data;
                    for (var key in data) {
                        if(key in this.form){
                            this.form[key] = data[key];

                        }
                    }
                })
                .catch((error) => {

                })
        }
    },
    mounted() {
        this.getData();
    }
}
</script>
