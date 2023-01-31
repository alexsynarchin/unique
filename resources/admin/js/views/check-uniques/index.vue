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
            >
                <template slot-scope="scope">
                    <el-tag class="admin-tag" type="info"> {{scope.row.type_title}}</el-tag>

                </template>
            </el-table-column>
            <el-table-column
                label="Действия"
            >

                <template slot-scope="scope">
                    <router-link :to="'show/' + scope.row.id">
                        <el-button
                            size="mini"
                            type="primary"> Просмотр</el-button>
                    </router-link>


                </template>
            </el-table-column>
        </data-tables>
    </section>
</template>
<script>

export default {
    data() {
        return {
            check_uniques: [],
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
    display: block !important;
    white-space: normal !important;
    height: auto;
    padding: 5px 4px;
    line-height: 20px;
    margin-bottom: 5px;
    &:nth-child(2n) {
        margin-top: 10px;
    }
}
</style>
