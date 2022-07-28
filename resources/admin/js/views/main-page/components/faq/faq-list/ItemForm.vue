<template>
    <el-form :model="form" ref="form" label-position="top" :rules="rules">

                <el-form-item label="Вопрос"  prop="question">
                    <el-input v-model="form.question"></el-input>
                </el-form-item>
                <el-form-item label="Ответ"  prop="answer">
                    <el-input type="textarea" v-model="form.answer"></el-input>
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
                question: [
                    {required:true, message: "Заполните вопрос"}
                ],
                answer: [
                    {required:true, message: "Заполните ответ"}
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
        uploadImage(file){
            let cond = this.beforeImageUpload(file.raw);
            this.form.image['imageName'] = file.raw.name;
            console.log(cond);

            if(cond){
                this.createImage(file);
            }
        },

        beforeImageUpload(file) {
            console.log(file.type);
            const isJPG = file.type === 'image/jpeg';
            const isPNG = file.type === 'image/png';
            const isSVG = file.type === 'image/svg+xml';
            const isLt2M = file.size / 1024 / 1024 < 2;

            if (!isJPG && !isPNG && !isSVG) {
                this.$message.error('Картинка должна быть в формате jpeg, png или svg');
            }
            if (!isLt2M) {
                this.$message.error('Размер не может превышать 2МБ');
            }
            return (isJPG || isPNG || isSVG) && isLt2M;
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
