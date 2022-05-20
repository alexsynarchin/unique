<template>
    <section>
        <div class="col-md-10">
            <el-row type="flex" class="mb-3">
                <el-col :span="12">
                    <el-button type="success" icon="el-icon-plus" @click.prevent="openModal">Добавить систему проверки</el-button>
                </el-col>
                <el-col :span="12">
                    <el-input
                        v-model="filters[0].value"
                        size="large"
                        width="100%"
                        placeholder="Название Системы"/>
                </el-col>
            </el-row>
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

            </data-tables>
        </div>
        <el-dialog
            title="Редактровать Api"
            :visible.sync="modalVisible"
            width="50%"
        >
        </el-dialog>
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
