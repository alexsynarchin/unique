<template>
    <section class="mb-4">

        <report-item

                    v-if="loaded"
                    :report="report"
                    :check_unique="check_unique"
                     @reportRestart="restartReport"
        ></report-item>
        <report-detail
            v-if="report.result && report.check_system.api_id"
            :report="report"
        ></report-detail>
    </section>
</template>
<script>
import ReportItem from "./report-item";
import ReportDetail from "./report-detail";
    export default {
        props:{
            check_unique: {},
            id:{},
        },
        components: {
            ReportItem, ReportDetail
        },
        data() {
            return {
                loaded:false,
                report: {},
            }
        },
        methods: {
            async restartReport() {

              this.getReportData();
            },
            async  getReportData() {

                do {
                    await axios.post('/api/report/'+ this.id + '/result')
                        .then((response) => {
                            this.report = response.data;
                            console.log(this.report.result)
                        })
                        .catch((error) => {
                            console.log(error.errors)
                        })
                } while (!this.report.result && !this.report.error_code)

            },
            async getReport() {

                await axios.get('/api/report/'+ this.id + '/show')
                    .then((response) => {
                        //console.log(response.data)
                        this.report = response.data;
                        this.loaded = true;
                        this.ymGoal();
                        if(!this.report.result && !this.report.error_code) {
                            this.$root.isLoading = false;
                            this.getReportData();
                        } else {
                            this.$root.isLoading = false;
                        }
                    })

            },
            ymGoal() {

                if(this.report.unique_order_id) {
                    ym(93111741, 'reachGoal', 'plat');
                } else {
                    ym(93111741, 'reachGoal', 'bespl');
                }
            },
            async getUid() {
                await axios.post('/api/report/'+ this.id + '/uid')
                    .then((response) => {
                        //console.log(response.data)
                        console.log('uid');
                        this.report.uid = response.data;
                        this.$root.isLoading = false;
                        this.getReportData();
                    })
            },
        },
        mounted() {

            this.$root.isLoading = true;
            this.getReport();
        }
    }
</script>
