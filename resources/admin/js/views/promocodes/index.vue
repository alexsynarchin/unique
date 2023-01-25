<template>
    <section >
        <div class="row">
            <div class="col-md-4">
                <el-button icon="el-icon-plus" type="primary" @click.prevent="addPromoCode">Новый промокод</el-button>
            </div>
        </div>
        <data-tables :data="tableData"  >
            <el-table-column
                type="index"
            >
            </el-table-column>
            <el-table-column
                label="Промокод"
                prop="name"
                width="200"
                sortable
            >
            </el-table-column>
            <el-table-column
                sortable
                label="Действует с"
                prop="start_time"
            >

            </el-table-column>
            <el-table-column
                sortable
                label="Заканчивается"
                prop="end_time"
            >
            </el-table-column>
            <el-table-column
                sortable
                label="Количество"
                prop="max_count"
            >
            </el-table-column>
            <el-table-column
                sortable
                label="Скидка"
                prop="discount"
            >
            </el-table-column>
            <el-table-column>
                <template slot-scope="scope">
                    <el-button
                        type="primary"
                        @click="handleEdit(scope.row)"
                        size="mini">
                        Редактировать
                    </el-button>
                    <el-button
                        type="danger"
                        @click="handleDelete(scope.row)"
                        size="mini">
                        Удалить
                    </el-button>
                </template>
            </el-table-column>
        </data-tables>
        <el-dialog
            :title="ModalTitle"
            :visible.sync="dialogVisible"
            width="50%"
            :before-close="handleClose">
            <create
                v-if="dialogVisible && state === 'create'"
                @close-modal=""
                @create-promo-code="createPromoCode"
            ></create>
            <edit v-if="dialogVisible && state === 'edit'"
                  :id="currentId"
                  @close-modal=""
                @edit-promo-code="editPromoCode"
            ></edit>
        </el-dialog>
    </section>
</template>
<script>
import Create from "./create";
import Edit from "./edit";
    export default {
        components: {
            Create, Edit
        },
        computed: {
            ModalTitle:function () {
                if(this.state === 'create') {
                    return "Новый промокод";
                } else if(this.state === 'edit') {
                    return "Редактировать промокод";
                } else {
                    return "";
                }
            }
        },
        data() {
            return {
                CanAccess: 'Просмотр "Промокоды"',
                tableData:[],
                dialogVisible:false,
                state:"",
                currentId: null,
            }
        },
        methods: {
            handleEdit(item) {
                this.currentId = item.id;
                this.dialogVisible = true;
                this.state = 'edit';
            },
            handleDelete(item) {
                this.$confirm('Вы уверены что хотите удалить промокод', 'Удаление промокода', {
                    confirmButtonText: 'Удалить',
                    cancelButtonText: 'Отмена',
                    type: 'warning'
                }).then(() => {
                    axios.delete('/api/admin/promo-codes/' + item.id)
                        .then((response) => {
                            let index = this.tableData.findIndex(item => item.id === response.data.id);
                            this.tableData.splice(index, 1);
                            this.$message({
                                type: 'success',
                                message: 'Промокод удален'
                            });
                        });

                }).catch(() => {

                });
            },
            editPromoCode(data) {
                let index = this.tableData.findIndex(item => item.id === data.id);
                this.tableData[index] =data;
                this.closeModal();
            },
            getTableData() {
                axios.get('/api/admin/promo-codes')
                    .then((response) => {
                        this.tableData = response.data;
                    })
            },
            createPromoCode(promo_code) {
                this.tableData.push(promo_code);
                this.closeModal();
            },
            closeModal() {
                this.dialogVisible = false
                this.currentId = null;
            },
            addPromoCode() {
                this.dialogVisible = true;
                this.state = 'create';
            },
            handleClose() {
                this.closeModal();
            },
        },
        mounted() {
            this.getTableData();
        }
    }
</script>
