<template>
    <el-form :model="form" label-position="top">
        <el-form-item class="" prop="discount_type" label="Тип скидки">
            <el-select v-model="form.discount_type" placeholder="Выбрать тип скидки" :error="errors.get('discount_type')">
                <el-option
                    v-for="item in discount_types"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value">
                </el-option>
            </el-select>
        </el-form-item>
        <div class="row">
            <el-form-item class="col-md-6" label="Время действия" prop="range" :error="errors.get('range')">
                <el-date-picker
                    v-model="form.range"
                    type="daterange"
                    range-separator="/"
                    start-placeholder="Дата начала"
                    end-placeholder="Дата завершения"
                    format="dd-MM-yyyy"
                    style="width: 100%"
                >
                </el-date-picker>
            </el-form-item>
            <el-form-item class="col-md-6" label="Размер скидки" prop="discount" :error="errors.get('discount')">
                <el-input-number v-model="form.discount" :step="5" :min="1"  step-strictly></el-input-number>
            </el-form-item>
        </div>
        <el-row :gutter="15">
            <el-col :span="14">
                <el-form-item label="Промокод (значение)" prop="name" :error="errors.get('name')">
                    <el-input v-model="form.name" ></el-input>
                </el-form-item>
            </el-col>
            <el-col :span="10">
                <el-form-item label="Количество использований" prop="max_count" :error="errors.get('max_count')">
                    <el-input-number v-model="form.max_count" :step="10" :min="0" ></el-input-number>
                </el-form-item>
            </el-col>
        </el-row>
        <div class="d-flex justify-content-center">
            <el-button icon="el-icon-plus" type="success" style="margin-right: 1rem" @click.prevent="submitForm('promoForm')">Добавить</el-button>
            <el-button @click="closeModal">Отмена</el-button>
        </div>
    </el-form>
</template>
<script>
import { Errors } from  '@/common/js/services/errors.js';
    export default {
        props:{
            form: {
                type:Object
            },
            action_type: {
                type:String
            },
            action_url: {
                type:String
            },
        },
        data() {
            return {
                discount_types:[
                    {
                        label: 'Проценты',
                        value: 'percent'
                    },
                    {
                        label: 'Рубли',
                        value: 'rubles'
                    },
                ],
                errors: new Errors(),
            }
        },
        methods: {
            closeModal() {
                this.$emit('close-modal');
            },
            submitForm(form) {
                axios({
                    method: this.action_type,
                    url: this.action_url,
                    data: this.form
                })
                    .then((response) => {
                        this.$emit('submit-form', response.data);
                    })
                    .catch((error) => {
                        this.errors.record(error.response.data.errors);
                    });
            },
        },
    }
</script>
