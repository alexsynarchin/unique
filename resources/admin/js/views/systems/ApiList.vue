<template>
    <section>
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
