<template>
    <section>
        <data-tables :data="contacts" :table-props="tableProps">
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
                label="Телефон"
                prop="phone"
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
                prop="created_at"
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
            title="Заявка на консультацию"
            :visible.sync="dialogVisible"
            width="90%"
            :before-close="handleClose">
            <show v-if="dialogVisible" :id="currentId"></show>
        </el-dialog>
    </section>
</template>
<script>
import show from './components/show'
    export default {
    components: {
        show,
    },
    data() {
        return {
            CanAccess:'Просмотр "Заявки"',
            contacts: [],
            dialogVisible:false,
            currentId:null,
            tableProps: {
                "row-class-name": function (row) {

                    if (row.row.status === 1) {
                        return 'warning-row';
                    }
                    return ''
                }
            },
        }
    },
        methods: {
        getContacts() {
            axios.get('/api/admin/contact-order')
                .then((response) => {
                    this.contacts = response.data;
                })
        },
            handleShow(id) {
                this.currentId = id;
                this.dialogVisible = true;
            },
            handleClose() {
                this.dialogVisible = false;
                this.currentId = null;
                this.getContacts();
            },
        },
        mounted() {
        this.getContacts();
        }
    }
</script>
<style>
.el-table .warning-row {
    background-color: #f8d7da;
}

.el-table .success-row {
    background: #f0f9eb;
}
</style>
