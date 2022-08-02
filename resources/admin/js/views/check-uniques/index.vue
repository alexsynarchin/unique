<template>
    <section>
        <div class="col-md-6 col-lg-4">
            <el-select style="width: 100%" v-model="type" filterable placeholder="Тип заявок на проверку уникальности"  @change="getCheckUniques">
                <el-option
                    v-for="item in types"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value"

                >
                </el-option>
            </el-select>
        </div>

        <data-tables :data="check_uniques" >
            <el-table-column
                type="index"
                label="№"
            >
            </el-table-column>
            <el-table-column
                label="e-mail"
                prop="email"
                sortable
            >
            </el-table-column>
            <el-table-column
                label="Дата"
                prop="formatted_date"
                sortable
            >
            </el-table-column>
            <el-table-column
                label="Кол-во систем проверки"
            >
                <template slot-scope="scope">
                    {{scope.row.reports.length}}
                </template>
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
            title="Отчет о проверке"
            :visible.sync="dialogVisible"
            width="90%"
            :before-close="handleClose">
           <check-report v-if="dialogVisible" :id="currentId"></check-report>
        </el-dialog>
    </section>
</template>
<script>
import CheckReport from "./components/report/index";
    export default {
        components: {CheckReport},
        data() {
            return {
                check_uniques: [],
                dialogVisible:false,
                currentId:null,
                type:null,
                types: [
                    {
                        label:"Автоматические",
                        value:0,
                    },
                    {
                        label:'Ручные',
                        value:1,
                    }
                ],
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
            getCheckUniques() {
                axios.get('/api/admin/check-uniques', {params:{type:this.type}})
                    .then((response) => {
                        this.check_uniques = response.data;
                    })
            },
        },
        mounted() {
            this.getCheckUniques();
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
