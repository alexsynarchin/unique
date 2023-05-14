<template>
    <section>
        <div class="row mb-4">
            <div class="col-md-6 col-lg-4">
                <label>
                    Система
                </label>
                <el-select style="width: 100%" v-model="listQuery.system" filterable placeholder=""  @change="getList">
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
                <el-select style="width: 100%" v-model="listQuery.price_type" filterable placeholder=""  @change="getList">
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
                <el-select style="width: 100%" v-model="listQuery.type" filterable placeholder=""  @change="getList">
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

        <el-table v-loading="listLoading" :data="list" border fit highlight-current-row style="width: 100%" :row-class-name="tableRowClassName">
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

                    <el-tag class="admin-tag" :type="item.error_code ? 'danger': 'success'" :key="index" v-for="(item, index) in scope.row.reports" style="word-break: normal;">
                        {{item.check_system.title}}
                        <template v-if="item.error_code"><br> !Ошибка Api</template>
                    </el-tag>
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
        </el-table>
        <pagination v-show="total>0" :total="total" :page.sync="listQuery.page" :limit.sync="listQuery.limit" @pagination="getList" />
    </section>
</template>
<script>
import Pagination from '@/admin/js/components/Pagination'; // Secondary package based on el-pagination
import Resource from '@/admin/js/api/resource';
const checkUniqueResource = new Resource('check-uniques');
export default {
    components: { Pagination },
    data() {
        return {
            list: null,
            total: 0,
            listLoading: true,
            listQuery: {
                page: 1,
                limit: 20,
                type:null,
                price_type:null,
                system: null
            },
            check_uniques: [],
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

        }
    },
    methods: {
        tableRowClassName({row, rowIndex}) {
            console.log(row);
            if (row.viewed === 0) {
                return 'warning-row';
            }
            return ''
        },
        async getList() {
            this.listLoading = true;
            const { data, meta } = await checkUniqueResource.list(this.listQuery);
            this.list = data;
            this.total = meta.total;
            this.listLoading = false;
        },
        getSystems() {
            axios.get('/api/admin/check-unique/systems')
                .then((response) => {
                    this.systems = response.data;
                })
        },
        getCheckUniques() {
            axios.get('/api/admin/check-uniques', {params:this.listQuery})
                .then((response) => {
                    this.check_uniques = response.data;
                })
        },
    },
    created() {
        this.getList();
    },
    mounted() {
        this.getSystems();
        this.getCheckUniques()
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
