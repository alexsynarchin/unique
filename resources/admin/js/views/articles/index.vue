<template>
    <section>
        <h1>Статьи</h1>
        <div class="mb-3">
            <el-button type="success" icon="el-icon-plus" @click="articleModalOpen('create')">Добавить</el-button>
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
                    <el-button
                        size="mini"
                        type="primary"
                        @click="handleEdit(scope.row)">Редактировать</el-button>
                    <el-button size="mini"
                               type="danger"
                               @click="handleDelete(scope.row.id)">Удалить </el-button>
                </template>
            </el-table-column>
        </data-tables>
        <el-dialog
            :before-close="closeModal"
            :visible.sync="showModal"
            width="60%"
            :title="articleModalTitle"
        >
            <create
                @close="closeModal"
                @store="storeArticle"
                v-if="showModal && articleModalStatus === 'create'"></create>
            <edit
                :id="currentId"
                @close="closeModal"
                @update="updateArticle"
                v-if="showModal && articleModalStatus === 'edit'"></edit>
        </el-dialog>
    </section>
</template>
<script>
    import create from "./create";
    import edit from "./edit";
    export default {
        components: {
            create, edit,
        },
        data() {
            return {
                CanAccess: 'Просмотр "Статьи"',
                currentId: null,
                articles: [],
                articleModalStatus: '',
                showModal:false,
            }
        },
        computed: {
            articleModalTitle:function () {
                if(this.articleModalStatus === 'create') {
                    return 'Новая статья';
                }
                if(this.articleModalStatus === 'edit') {
                    return 'Редактировать статью';
                }
            },
        },
        methods: {
            getArticles() {
                axios.get('/api/admin/articles')
                    .then((response) => {
                        this.articles = response.data;
                    })
            },
            articleModalOpen(status) {
                this.articleModalStatus = status;
                this.showModal = true;
            },
            handleEdit(item) {
                this.currentId = item.id;
                this.articleModalStatus = 'edit';
                this.showModal = true;
            },
            updateArticle(data) {
                let index = this.articles.findIndex(object => {
                    return object.id === data.id;
                });
                this.articles[index].title = data.title;
                this.articles[index].date = data.date;
                this.closeModal();
            },
            storeArticle(data) {
                this.articles.push(data);
                this.closeModal();
            },
            closeModal() {
                this.showModal = false;
                this.currentId = null;
                this.articleModalStatus = '';
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
