<template>
    <section>
        <el-card class="box-card mb-4">
            <div slot="header" class="clearfix">
                <h5>Основная информация</h5>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>
                        Имя:
                    </label>
                    <span>
                            {{item.name}}
                        </span>
                </div>
                <div class="col-md-6">
                    <label>
                        E-mail:
                    </label>
                    <span>
                            {{item.email}}
                        </span>
                </div>
            </div>
            <div class="row  mb-3">
                <div class="col-md-6">
                    <label>
                        Необходимые сроки:
                    </label>
                    <span>
                            {{item.date}}
                        </span>
                </div>
                <div class="col-md-6">
                    <label>
                        Статус:
                    </label>
                    <span>
                        {{item.status_title}}
                    </span>
                </div>
            </div>
            <div class="mb-4">
                <label>
                    Комментарий
                </label>
                <div>
                    {{item.comment}}
                </div>
            </div>
            <label>Текст:</label>
            <el-link :href="item.file_link" icon="el-icon-document" v-if="item.filename" download>Скачать файл</el-link>
            <div class="page-block" v-else>
                {{item.plain_text}}
            </div>
        </el-card>

        <el-form :model="form">
            <div class="row">
                <el-form-item  class="col-md-4" label="Стоимость">
                    <el-input-number v-model="form.price"/>
                </el-form-item>
                <el-form-item label="Статус" class="col-md-4">
                    <el-select v-model="form.status" placeholder="Select">
                        <el-option
                            v-for="item in statuses"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <div class="col-md-4">
                    <el-button type="success" @click.prevent="update">
                        Сохранить
                    </el-button>
                </div>
            </div>
        </el-form>
    </section>
</template>
<script>
    export default {
        props: {
            id: {
                type:Number
            }
        },
        data() {
            return {
                statuses: [
                    {
                        label: "Не просмотрена",
                        value: 0,
                    },
                    {
                        label: "Новая",
                        value: 1,
                    },
                    {
                        label: "В работе",
                        value: 2,
                    },
                    {
                        label: "Завершена",
                        value: 3,
                    },
                ],
                item: {},
                form: {
                    price: 0,
                    status: 0,
                },
            }
        },
        methods: {
            getData() {
                axios.get('/api/admin/rewrite/' + this.id)
                    .then((response) => {
                        this.item = response.data;
                        let keys = ['price', 'status'];
                        keys.forEach(key => {
                            this.form[key] = response.data[key];
                        })
                    })
            },
            update() {
                axios.put('/api/admin/rewrite/' + this.id, this.form)
                    .then((response) => {
                        this.item = response.data;
                        this.$notify({
                            title: 'Информация обновлена',
                            type: 'success'
                        });
                    })
            },
        },
        async mounted() {
            await this.getData();
        }
    }
</script>
