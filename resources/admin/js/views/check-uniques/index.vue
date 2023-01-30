<template>
    <section>
        <div class="row mb-4">
            <div class="col-md-6 col-lg-4">
                <label>
                    Система
                </label>
                <el-select style="width: 100%" v-model="system" filterable placeholder=""  @change="getCheckUniques">
                    <el-option
                        v-for="item in systems"
                        :key="item.id"
                        :label="item.title"
                        :value="item.id"
                    >
                    </el-option>
                </el-select>
            </div>
            <div class="col-md-6 col-lg-4">
                <label>
                    Статус
                </label>
                <el-select style="width: 100%" v-model="priceType" filterable placeholder=""  @change="getCheckUniques">
                    <el-option
                        v-for="item in priceTypes"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value"
                    >
                    </el-option>
                </el-select>
            </div>
            <div class="col-md-6 col-lg-4">
                <label>
                    Формат
                </label>
                <el-select style="width: 100%" v-model="type" filterable placeholder=""  @change="getCheckUniques">
                    <el-option
                        v-for="item in types"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value"
                    >
                    </el-option>
                </el-select>
            </div>
        </div>
        <data-tables :data="check_uniques"  :table-props="tableProps">
            <el-table-column
                label="№"
            >
                <template slot-scope="scope">
                    Запрос № {{scope.row.id}}
                </template>
            </el-table-column>
            <el-table-column
                label="e-mail"
                prop="email"
                sortable
            >
            </el-table-column>
            <el-table-column
                label="Дата время"
                prop="formatted_date"
                sortable
            >
            </el-table-column>
            <el-table-column
                label="Сумма"
                prop="sum"
                sortable
            >
            </el-table-column>
            <el-table-column
                label="Системы проверки"
            >
                <template slot-scope="scope">
                    <el-tag class="admin-tag" type="success" :key="index" v-for="(item, index) in scope.row.reports" style="word-break: normal;">
                        {{item.check_system.title}}</el-tag>
                </template>
            </el-table-column>
            <el-table-column
                label="Услуги"
            >
                <template slot-scope="scope" >
                 <el-tag class="admin-tag" :key="index" v-for="(item, index) in scope.row.services">
                      {{item.title}}
                 </el-tag>
                </template>
            </el-table-column>
            <el-table-column
                label="Формат"
                prop="type_title"
                ></el-table-column>
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
                CanAccess:'Просмотр "Системы проверки"',
                check_uniques: [],
                dialogVisible:false,
                currentId:null,
                type:null,
                priceType:null,
                system:null,
                priceTypes: [
                    {
                        label:'Бесплатные',
                        value:0
                    },
                    {
                        label:'Платные',
                        value:1
                    },

                ],
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
                systems: [],
                tableProps: {
                    "row-class-name": function (row) {

                        if (row.row.viewed === 0) {
                            return 'warning-row';
                        }
                        return ''
                    }
                },
            }
        },
        methods: {
            getSystems() {
                axios.get('/api/admin/check-unique/systems')
                    .then((response) => {
                        this.systems = response.data;
                    })
            },
            handleClose() {
                this.dialogVisible = false;
                this.currentId = false;
            },
            handleShow(id) {
                this.currentId = id;
                this.dialogVisible = true;
                let index = this.check_uniques.findIndex(item => item.id === id);
                this.check_uniques[index].viewed = 1;
            },
            getCheckUniques() {
                axios.get('/api/admin/check-uniques', {params:{type:this.type, system: this.system, price_type:this.priceType}})
                    .then((response) => {
                        this.check_uniques = response.data;
                    })
            },
        },
        mounted() {
            this.getCheckUniques();
            this.getSystems();
        }
    }
</script>
<style lang="scss">
.el-table .warning-row {
    background: oldlace;
}

.el-table .success-row {
    background: #f0f9eb;
}
.admin-tag {
    width: 100%;
    text-align: center;
    &:nth-child(2n) {
        margin-top: 10px;
    }
}
</style>
