<template>
    <section>
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
        </el-dialog>
    </section>
</template>
<script>
import Create from "./create";
    export default {
        components: {
            Create
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
                tableData:[],
                dialogVisible:false,
                state:"",
            }
        },
        methods: {
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
