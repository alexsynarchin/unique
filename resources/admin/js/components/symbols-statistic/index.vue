<template>
    <el-card>
        <div slot="header" class="clearfix">
            <span>Статистика использования символов</span>
            <el-button size="small" type="success" @click.prevent="getSymbolsStatistic">Проверить</el-button>
        </div>
    <div class="d-flex flex-wrap gap-2 mb-3">
        <div>

            <label style="display: block" class="form-label">Выбрать период</label>
            <el-date-picker
                style="min-width: 400px; width: 100%"
                v-model="symbolsStatisticRange"
                :picker-options="pickerOptions"
                format="yyyy-MM-dd HH:mm"
                value-format="yyyy-MM-dd HH:mm"
                type="datetimerange"

                @change=""
                start-placeholder="Время начала"
                end-placeholder="Время окончания">
            </el-date-picker>
        </div>
        <div>

            <label style="display: block" class="form-label">Тип проверки</label>
            <el-select v-model="checkUniquePaymentFree" placeholder="Тип проверки">
                <el-option
                    v-for="item in checkUniqueTypes"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value">
                </el-option>
            </el-select>
        </div>
        <div>
            <label style="display: block" class="form-label">Сервис проверки</label>
            <el-select v-model="checkUniqueServiceId" placeholder="Сервис проверки">
                <el-option
                    v-for="item in  checkUniqueServices"
                    :key="item.title"
                    :label="item.title"
                    :value="item.id">
                </el-option>
            </el-select>
        </div>
    </div>
        <div class="mp-card__sum">
            {{symbols}}
        </div>
    </el-card>
</template>
<script>
import dayjs from "dayjs";
require('dayjs/locale/ru');
    export  default {
        data() {
            return {
                symbols:0,
                checkUniqueServiceId:1,
                checkUniqueServices: [],
                checkUniquePaymentFree: 1,
                checkUniqueTypes: [
                    {
                        label: "Платная",
                        value: 0
                    },
                    {
                        label:'Бесплатная',
                        value: 1
                    }
                ],
                symbolsStatisticRange: null,
                pickerOptions: {
                    shortcuts: [
                        {
                            text: 'За час',
                            onClick(picker) {
                                const end = new Date();
                                const start = new Date();
                                start.setTime(start.getTime() - 3600 * 1000);
                                picker.$emit('pick', [start, end]);
                            }
                        },
                        {
                            text: 'Сутки',
                            onClick(picker) {
                                const end = new Date();
                                const start = new Date();
                                start.setTime(start.getTime() - 3600 * 1000 * 24);
                                picker.$emit('pick', [start, end]);
                            }
                        },
                        {
                        text: 'Неделя',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                            picker.$emit('pick', [start, end]);
                        }
                    },
                    ]
                },
            }
        },
        methods: {

            getDefaultStatisticRange() {
                const end = new Date();
                const start = new Date();
                start.setTime(start.getTime() - 3600 * 1000 * 24);

                this.symbolsStatisticRange = [dayjs(start).format("YYYY-MM-DD HH:mm"),
                    dayjs(end).format("YYYY-MM-DD HH:mm")]
            },
            getSymbolsStatistic() {
                axios.get('/api/admin/check-unique-service-statistic/symbols',
                    {params: {
                        api_id:this.checkUniqueServiceId,
                        payment_free: this.checkUniquePaymentFree,
                        range:  this.symbolsStatisticRange
                        }})
                    .then((response) => {
                        this.symbols = response.data;
                    })
            },
            getCheckUniqueServicesList() {
                axios.get('/api/admin/check-unique-service-statistic/services')
                    .then((response) => {
                      this.checkUniqueServices = response.data;

                    })
            }
        },
        mounted() {
            this.getCheckUniqueServicesList();
            this.getDefaultStatisticRange();
            this.getSymbolsStatistic()
        }
    }
</script>
