<template>
    <el-form :model="form" ref="form" label-position="top" :rules="rules">

        <el-form-item label="Заголовок"  prop="title">
            <el-input v-model="form.title"></el-input>
        </el-form-item>
        <el-form-item label="Проценты"  prop="title">
            <el-select value-key="num" v-model="form.unique_percent" placeholder="Процент уникальности">
                <el-option
                    v-for="item in options"
                    :key="item.num"
                    :label="item.label"
                    :value="item">
                </el-option>
            </el-select>
        </el-form-item>
        <el-form-item label="Текст">
            <el-input type="textarea" v-model="form.description"></el-input>
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
                    label: "85-100%",
                    num:100,
                },
                {
                    label: "71-85%",
                    num:85,
                },
                {
                    label: "50-70%",
                    num:70,
                },
                {
                    label: "0-50%",
                    num:50,
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

    }
}
</script>
