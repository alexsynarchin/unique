<template>
    <section>
        <div class="row" v-if="can(CanAccess) || is('Super-Admin')">
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


        <data-tables :data="check_uniques" >
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
                label="Кол-во систем проверки"
            >
                <template slot-scope="scope">
                    <el-tooltip placement="top" v-if="scope.row.reports.length > 0">
                        <div slot="content"><span v-for="(item, index) in scope.row.reports">
                            {{item.check_system.title + ', '}}
                        </span>
                        </div>
                        <span>
                            <span>{{scope.row.reports.length}}</span>
                            <i class="el-icon-question"></i>
                        </span>

                    </el-tooltip>
                </template>
            </el-table-column>
            <el-table-column
                label="Услуги"
            >
                <template slot-scope="scope" >
                    <el-tooltip placement="top" v-if="scope.row.services.length > 0">
                        <div slot="content"><span v-for="(item, index) in scope.row.services">
                              {{item.title + ', '}}
                        </span>
                        </div>
                        <span>
                            <span>{{scope.row.reports.length}}</span>
                            <i class="el-icon-question"></i>
                        </span>
                    </el-tooltip>
                    <div  v-else>0</div>
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

                        if (row.row.status === 0) {
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
<style>
.el-table .warning-row {
    background: oldlace;
}

.el-table .success-row {
    background: #f0f9eb;
}
</style>
