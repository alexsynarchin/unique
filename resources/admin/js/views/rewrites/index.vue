<template>
    <section>
        <data-tables :data="rewrites" :table-props="tableProps">
            <el-table-column
                type="index"
                label="№"
            >
            </el-table-column>
            <el-table-column
                label="Имя"
                prop="name"
                sortable
            >
            </el-table-column>
            <el-table-column
                label="e-mail"
                prop="email"
                sortable
            >
            </el-table-column>
            <el-table-column
                label="Статус"
                prop="status_title"
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
                        @click="handleShow(scope.row.id)">Подробнее</el-button>

                </template>
            </el-table-column>
        </data-tables>
        <el-dialog
            title="Заявка на рерайт"
            :visible.sync="dialogVisible"
            width="90%"
            :before-close="handleClose">
            <show v-if="dialogVisible" :id="currentId"></show>
        </el-dialog>
    </section>
</template>
<script>
import Show from "./components/show";
export default {
    components: {Show},
    data() {
        return {
            rewrites: [],
            dialogVisible:false,
            currentId:null,
            type:null,
            tableProps: {
                "row-class-name": function (row) {

                    if (row.row.status === 0) {
                        return 'warning-row';
                    }

                    return ''
                }
            },
        }
    },
    methods: {
        handleClose() {
            this.dialogVisible = false;
            this.currentId = false;
        },
        handleShow(id) {
            this.currentId = id;
            this.dialogVisible = true;
        },
        getRewrites() {
            axios.get('/api/admin/rewrites')
                .then((response) => {
                    this.rewrites = response.data;
                })
        },
    },
    mounted() {
        this.getRewrites();
    }
}
</script>
<style>
.el-table .warning-row {
    background: oldlace;
}

.el-table .success-row {
    background: #f0f9eb;
}
</style>
