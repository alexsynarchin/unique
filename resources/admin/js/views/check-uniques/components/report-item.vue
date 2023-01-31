<template>
    <section class="report-item">
        <h3 class="report-item__title">
            Проверка {{report.formatted_date}}
        </h3>
        <div class="report-item__content"  >
            <div class="report-item-system">
                <h4 class="report-item-system__title">
                    {{check_system.title}}
                </h4>
                <figure class="report-item-system__logo">
                    <img :src="check_system.logo">
                </figure>
            </div>
            <section class="report-item__center">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div>
                        <el-tag type="success" v-if="report.result">
                            Отчет сформирован
                        </el-tag>
                        <el-tag type="warning" v-else>
                            Отчет не сформирован
                        </el-tag>
                        <el-tag type="primary">{{checkUniqueTypeString}}</el-tag>
                    </div>
                    <el-button type="primary" v-if="!report.check_system.api_id" @click.prevent="$refs.reportSend.openModal()">Отправить отчет</el-button>
                </div>


                    <div v-if="report.result">
                        <div class="report-progress-bar" v-if="report.result">
                            <progress-bar
                                bg-color="#E3E5ED"
                                bar-color="#366AF3"
                                :bar-border-radius="30"
                                size="15"
                                :val="report.data.unique"></progress-bar>
                            <div class="report-progress-bar__text">
                                <span class="report-progress-bar__precent">{{report.data.unique + '%'}}</span>
                                Текст неуникальный
                            </div>
                        </div>


                </div>
            </section>
            <section class="report-item__right">
                <ul class="report-text-params">
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Номер отчета:
                        </label>
                        <span class="report-text-params__value">
                            {{check_unique.id}}
                        </span>
                    </li>
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Страниц:
                        </label>
                        <span class="report-text-params__value">
                            {{check_unique.pages}}
                        </span>
                    </li>
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Слов:
                        </label>
                        <span class="report-text-params__value">
                             {{check_unique.wordsCount}}
                        </span>
                    </li>
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Символов:
                        </label>
                        <span class="report-text-params__value">
                            {{check_unique.symbolsCount}}
                        </span>
                    </li>
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Тип документа:
                        </label>
                        <span class="report-text-params__value">
                                {{check_unique.type}}
                        </span>
                    </li>
                </ul>
                <div class="report-item-bnts">
                    <el-button type="primary" @click.prevent="downloadPdf" v-if="report.result">
                        Скачать отчет
                    </el-button>
                </div>
            </section>
        </div>
        <report-send @refresh-data="refreshData" :report="report" ref="reportSend"></report-send>
    </section>
</template>
<script>
import ProgressBar from 'vue-simple-progress';
import ReportSend from "@/admin/js/views/check-uniques/components/report-send.vue";
    export default {
    components: {
        ProgressBar, ReportSend
    },
        computed: {
            checkUniqueTypeString: function () {
                if(this.report.check_system.api_id) {
                    return 'Автоматическая проверка'
                } else {
                    return 'Ручная проверка'
                }
            },
            reportBtnString: function () {
                if(this.report.result) {
                    return 'Отправить отчет заново'
                } else {
                    return 'Отправить отчет'
                }
            }
        },
        data() {
        return {
            check_system: {},
            increasing_pct: 0,
            decreasing_pct: 100,
        }
        },
        props: {
            report: {
                type:Object,
            },
            check_unique: {
                type:Object,
            },
        },
        methods: {
        refreshData() {
            this.$emit('refresh-data')
        },
            downloadPdf() {
                this.$root.isLoading = true;
                axios.post('/api/report/' +this.report.id + '/download')
                    .then((response) => {
                        console.log(response.data);
                        this.$root.isLoading = false;
                        let link = document.createElement('a')
                        link.href = response.data;
                        link.download = 'report'
                        link.click()
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            },
        },
        mounted() {
        this.check_system = this.report.check_system;
        if(!this.report.result) {
            setInterval(() => {
                if (this.is_paused)
                    return
                this.random_pct = Math.ceil(Math.random() * 100)
                this.increasing_pct = Math.min(this.increasing_pct + 2, 100)
                this.decreasing_pct = Math.max(this.decreasing_pct - 2, 0)
                }, 3500)
            }

        }
    }
</script>
