<template>
    <section class="report-block" v-if="loaded">
        <systems-list :selected="selectedSystems"></systems-list>
        <report  v-for="(item, index) in check_unique.reports"
            :key="item.id"
             :id="item.id"
             :check_unique="check_unique"
             v-if="loaded"
        ></report>
    </section>
</template>
<script>
import SystemsList from "./components/systems-list";
import Report from "./components/report";

    export default {
        components: {
            SystemsList, Report,
        },
        props: {
            id: {
                type:Number,
            }
        },
        data() {
            return {
                loaded:false,
                selectedSystems: [],
                check_unique: {},

            }
        },
        methods: {
            getCheckUnique() {
                axios.get('/api/check-unique/' + this.id + '/show')
                    .then((response) => {
                      this.check_unique = response.data;
                      this.loaded = true;
                        this.$root.isLoading = false;
                       this.check_unique.reports.forEach((item)=> {
                           this.selectedSystems.push(item.system_id);
                       })
                    })
            },

        },
        mounted() {
            this.$root.isLoading = true;
            this.getCheckUnique();

        }
    }
</script>
