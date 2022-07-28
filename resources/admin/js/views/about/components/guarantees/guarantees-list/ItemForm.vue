<template>
    <el-form :model="form" ref="form" label-position="top" :rules="rules">
                <el-form-item label="Текст" prop="text">
                    <el-input type="textarea" rows="6" v-model="form.text"></el-input>
                </el-form-item>
        <el-button  type="success" @click="submitForm('form')">Сохранить элемент</el-button>
    </el-form>
</template>
<script>
export default {
    props: {
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
                text: [
                    {required:true, message: "Заполните текст"}
                ]
            },
        }
    },
    methods: {
        submitForm(formName) {

            this.$refs[formName].validate((valid) => {
                if (valid) {
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

    }
}
</script>
