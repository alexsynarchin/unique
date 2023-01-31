<template>
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <h5>Заявка №{{id}}</h5>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>
                        E-mail:
                    </label>
                    <span>
                            {{check_unique.email}}
                        </span>
                </div>
            </div>
            <label>Текст:</label>
            <el-link :href="check_unique.file_link" icon="el-icon-document" v-if="check_unique.filename" download>Скачать файл</el-link>
            <div class="page-block mb-3" v-else>
                {{check_unique.plainText}}
            </div>
        <systems-list :selected="selectedSystems"></systems-list>
        <report  v-for="(item, index) in check_unique.reports"
                 :key="item.id"
                 :id="item.id"
                 :check_unique="check_unique"
                 v-if="loaded"
                 @refresh-data="this.getCheckUnique()"
        ></report>
        </el-card>
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
            type:String,
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
        setViewed() {
            axios.get('/api/admin/check-unique/' + this.id + '/show')
        }

    },
    mounted() {
        this.$route.meta.title = this.$route.meta.title + this.$route.params.id;
        this.$root.isLoading = true;
        this.getCheckUnique();
        this.setViewed();
    }
}
</script>
