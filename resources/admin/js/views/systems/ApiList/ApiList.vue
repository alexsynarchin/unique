<template>
    <section>
        <el-menu default-active="/check-systems/api" class="el-menu-demo" mode="horizontal"  :router="true"  >
            <el-menu-item index='/check-systems/list' >Системы проверки</el-menu-item>
            <el-menu-item index="/check-systems/api">Api систем проверки</el-menu-item>
        </el-menu>
        <div class="col-md-10">

            <data-tables :data="tableData">
                <el-table-column
                    type="index"
                >
                </el-table-column>
                <el-table-column
                    label="Название"
                    prop="title"
                    width="200"
                    sortable
                >
                </el-table-column>
                <el-table-column>
                    <template slot-scope="scope">
                        <router-link :to="'api/' + scope.row.id" class="el-button el-button--primary el-button--small">
                            <i class="el-icon-setting"></i>
                            Настройки
                        </router-link>
                    </template>
                </el-table-column>
            </data-tables>
        </div>
    </section>
</template>
<script>
    export default {
        data() {
            return {
                modalVisible:false,
                tableData:[],
                filters: [{
                    prop: 'title',
                    value: ''
                }],
            }
        },
        methods: {
            getList() {
                axios.get('/api/admin/check-api/list')
                    .then((response) => {
                        this.tableData = response.data;
                    })
            },
            openModal() {

            }
        },
        mounted() {
            this.getList();
        }
    }
</script>
