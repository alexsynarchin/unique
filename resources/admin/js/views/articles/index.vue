<template>
    <section>
        <h1>Статьи</h1>
        <el-tabs type="card" v-model="activeTab">
            <el-tab-pane label="Основная информация" name="main">
        <div class="mb-3">
            <router-link to="create">
                <el-button type="success" icon="el-icon-plus">Новая статья</el-button>
            </router-link>

        </div>
        <data-tables :data="articles">
            <el-table-column
                type="index"
                label="№"
            >
            </el-table-column>
            <el-table-column
                label="Заголовок"
                prop="title"
                sortable
            >
            </el-table-column>
            <el-table-column
                label="Дата"
                prop="date"
                sortable
            >
            </el-table-column>
            <el-table-column
                label="Действия"
            >
                <template slot-scope="scope">
                    <router-link :to="'edit/'+ scope.row.id">
                        <el-button
                            size="mini"
                            type="primary">
                            Редактировать
                        </el-button>
                    </router-link>

                    <el-button size="mini"
                               type="danger"
                               @click="handleDelete(scope.row.id)">Удалить </el-button>
                </template>
            </el-table-column>
        </data-tables>
            </el-tab-pane>
            <el-tab-pane label="Настройки и SEO" name="config">
                <Seo :form = "seo" v-if="seo"></Seo>
                <el-button type="success" @click.prevent="submitSeo">Сохранить</el-button>
            </el-tab-pane>
        </el-tabs>
    </section>
</template>
<script>
import Seo from '@/admin/js/components/seo/seo.vue'
    export default {
        components: {
            Seo,
        },
        data() {
            return {
                articles: [],
                activeTab: 'main',
                seo: {
                    title: "",
                    description: "",
                    keywords: "",
                },
            }
        },
        computed: {

        },
        methods: {
            submitSeo() {

            },
            getArticles() {
                axios.get('/api/admin/articles')
                    .then((response) => {
                        this.articles = response.data;
                    })
            },
            handleDelete(id) {
                axios.delete('/api/admin/article/' + id)
                    .then((response) => {
                        let index = this.articles.findIndex(object => {
                            return object.id === id;
                        });
                        this.articles.splice(index,1)
                    })
            },
        },
        mounted() {
            this.getArticles();
        }
    }
</script>
