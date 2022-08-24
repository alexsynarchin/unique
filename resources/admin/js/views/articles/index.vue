<template>
    <section>

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
                    <el-button
                        size="mini"
                        type="primary"
                        @click="handleEdit(scope.row)">Редактировать</el-button>
                    <el-button size="mini"
                               type="danger"
                               @click="handleDelete(scope.row.id)"></el-button>
                </template>
            </el-table-column>
        </data-tables>
    </section>
</template>
<script>
    export default {
        data() {
            return {
                articles: [],
            }
        },
        methods: {
            getArticles() {
                axios.get('/api/admin/articles')
                    .then((response) => {
                        this.articles = response.data;
                    })
            },
            handleEdit(item) {

            },
            handleDelete(id) {

            },
        },
        mounted() {
            this.getArticles();
        }
    }
</script>
