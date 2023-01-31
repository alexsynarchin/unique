<template>
    <section class="mb-4">

        <report-item v-if="loaded"
                     :report="report"
                    :check_unique="check_unique"
                     @refresh-data="this.getReport"
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

            async getReport() {

                await axios.get('/api/report/'+ this.id + '/show')
                    .then((response) => {
                        //console.log(response.data)
                        this.report = response.data;
                        this.loaded = true;
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
