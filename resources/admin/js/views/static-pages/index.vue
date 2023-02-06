<template>
    <section class="items-list" >
        <el-row type="flex" class="mb-3">
            <el-col :span="12">
                <router-link to="create">
                    <el-button type="success" icon="el-icon-plus">Добавить Страницу</el-button>
                </router-link>
            </el-col>
            <el-col :span="12">
                <el-input
                    v-model="filters[0].value"
                    size="large"
                    width="100%"
                    placeholder="Название"/>
            </el-col>
        </el-row>
        <data-tables :data="pages"  :filters="filters">
            <el-table-column
                type="index"
            >
            </el-table-column>
            <el-table-column
                label="Название"
                sortable
            >
                <template slot-scope="scope">
                    <div style="word-break: normal">
                        {{scope.row.name}}
                    </div>
                </template>
            </el-table-column>
            <el-table-column
                label="url"
                sortable

            >
                <template slot-scope="scope">
                    {{scope.row.slug}}
                </template>
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
                    <el-button
                        size="mini"
                        type="danger"
                        @click="handleDelete(scope.$index, scope.row)">Удалить</el-button>
                </template>
            </el-table-column>
        </data-tables>
    </section>
</template>
<script>

export default {

    components: {

    },
    methods:{
        handleDelete(index,row) {
            axios.delete('/api/admin/static-page/'+ row.id)
                .then((response) => {
                    this.pages.splice(index, 1);
                })
        },
        getPages()
        {
            axios.get('/api/admin/static-pages')
                .then((response) => {
                    this.pages = response.data
                })
        }

    },
    data(){
        return{
            pages:[],
            filters: [{
                prop: 'name',
                value: ''
            }],
        }
    },
    mounted() {
        this.getPages();
    }
}
</script>
