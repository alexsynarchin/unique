<template>
    <el-form class="mb-4" :model="form" label-position="top">

        <div class="row align-items-end">
            <el-form-item class="col-md-4"   prop="title" label="Заголовок списка">
                <el-input v-model="form.title"></el-input>
            </el-form-item>
            <el-form-item class="col-md-4" label="Название колонки списка">
                <el-input v-model="form.options.label"></el-input>
            </el-form-item>
            <el-form-item class="col-md-4">
                <el-checkbox v-model="form.options.button" label="Кнопка проверить уникальность" border></el-checkbox>
            </el-form-item>

        </div>
        <el-button icon="el-icon-plus" type="primary" @click.prevent="submitForm">{{button_text}}</el-button>
        <el-button type="default" @click.prevent="cancelEdit" v-if="cancelBtn">Отмена</el-button>
    </el-form>
</template>
<script>
export default {
    props: {
        cancelBtn: {
            type:Boolean,
            default:false,
        },
        button_text: {
            type:String,
        },
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
    methods: {
        submitForm() {
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
        },
        cancelEdit() {
            this.$emit('cancel')
        }
    }
}
</script>
