<template>
    <section class="mb-4">
        <report-item v-if="loaded"
                     :report="report"
                    :check_unique="check_unique"
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
            sendMail(){
                axios.post('/api/report/'+this.id + '/send-email', {email:this.check_unique.email})
                    .then((response) => {
                        console.log(response.data);
                    })
            },
            async  getReportData() {

                do {
                    await axios.post('/api/report/'+ this.id + '/result')
                        .then((response) => {
                            this.report = response.data;
                        })
                } while (!this.report.result && !this.report.error_code)

            },
            async getReport() {

                await axios.get('/api/report/'+ this.id + '/show')
                    .then((response) => {
                        //console.log(response.data)
                        this.report = response.data;
                        this.loaded = true;
                        if(!this.report.check_system.manual && !this.report.result && !this.report.error_code) {
                            this.$root.isLoading = false;
                            this.getReportData();
                        } else {
                            this.$root.isLoading = false;
                        }



                    })
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
