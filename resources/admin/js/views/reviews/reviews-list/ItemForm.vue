<template>
    <el-form :model="form" ref="form" label-position="top" :rules="rules">

                <el-form-item label="Заголовок"  prop="title">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>
                <el-form-item label="Текст">
                    <el-input rows="6" type="textarea" v-model="form.description"></el-input>
                </el-form-item>
                <el-form-item label="Тип услуги"  prop="type">
                    <el-select value-key="value" v-model="form.type" placeholder="Процент уникальности">
                        <el-option
                            v-for="item in options"
                            :key="item.value"
                            :label="item.label"
                            :value="item">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Имя"  prop="name">
                    <el-input v-model="form.name"></el-input>
                </el-form-item>
                <el-form-item label="Дата">
                    <el-date-picker
                        v-model="form.date"
                        type="date"
                        placeholder="Выбрать дату"
                        format="yyyy-MM-dd"
                        value-format="yyyy.MM.dd"
                    >
                    </el-date-picker>
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
            options: [
                {
                    label:"Проверка уникальности",
                    value:"check_unique"
                },
                {
                    label:"Повышение уникальности",
                    value:"up_unique"
                },
            ],
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
