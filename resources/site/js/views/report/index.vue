<template>
    <section class="report-block" v-if="loaded">
        <systems-list></systems-list>
        <report-item v-if="loaded" :report="report"></report-item>
        <report-detail
            v-if="report.result"
            :report="report"
        ></report-detail>
        <div class="report-item-descr check-unique-descr">
            <figure class="report-item-descr__icon check-unique-descr__icon">
                <img src="/assets/site/images/union.png">
            </figure>
            <div class="report-item-descr__content check-unique-descr__content">
                Обращаем ваше внимание, что система отвечает на вопрос, является тот или иной фрагмент текста заимствованным или нет. Ответ на вопрос, является ли фрагмент именно плагиатом, а не законной цитатой, система оставляет на ваше усмотрение.
            </div>
        </div>
    </section>
</template>
<script>
import SystemsList from "./components/systems-list";
import ReportItem from "./components/report-item";
import ReportDetail from "./components/report-detail";
    export default {
        components: {
            SystemsList, ReportItem, ReportDetail
        },
        props: {
            id: {
                type:Number,
            }
        },
        data() {
            return {
                loaded:false,
                report: {},

            }
        },
        methods: {
            getReportData() {
                axios.post('/api/report/'+ this.id + '/result')
                    .then((response) => {
                        this.report = response.data;
                        this.loaded = true;
                    })
            },
            getReport() {
                axios.get('/api/report/'+ this.id + '/show')
                    .then((response) => {
                        //console.log(response.data)
                        this.report = response.data;
                        if(!this.report.uid) {
                            this.getUid();
                            this.loaded = true;
                            this.getReportData()
                        }
                        else if(!this.report.result) {
                            this.$root.isLoading = false;
                            this.getReportData()
                        }
                        else {
                            this.loaded = true;
                            this.$root.isLoading = false;
                        }

                    })
            },
            getUid() {
                axios.post('/api/report/'+ this.id + '/uid')
                    .then((response) => {
                        //console.log(response.data)
                        console.log('uid');
                        this.report.uid = response.data;
                        this.$root.isLoading = false;
                    })
            },
        },
        mounted() {
            this.$root.isLoading = true;
            this.getReport();
        }
    }
</script>
