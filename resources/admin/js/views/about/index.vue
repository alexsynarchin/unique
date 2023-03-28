<template>
    <section>
        <h1>Страница о компании</h1>
        <el-tabs type="card" v-model="activeTab">
            <el-tab-pane label="Основная информация" name="main">
                <utp class="mb-5"></utp>
                <ratings class="mb-5"></ratings>
                <guarantees class="mb-5"></guarantees>
                <work-result></work-result>
            </el-tab-pane>
            <el-tab-pane label="Настройки и SEO" name="config">
                <Seo :form = "seo" v-if="seo"></Seo>
                <el-button type="success" @click.prevent="submitSeo">Сохранить</el-button>
            </el-tab-pane>
        </el-tabs>

    </section>
</template>
<script>
import utp from './components/utp'
import ratings from "./components/ratings/ratings";
import guarantees from "./components/guarantees/guarantees";
import WorkResult from "./components/work-result/WorkResult";
import Seo from '@/admin/js/components/seo/seo.vue'
    export default {
        components: {
            utp, ratings, guarantees, WorkResult, Seo,
        },
        data() {
            return {
                activeTab: 'main',
                slug: "about",
                page_id:null,
                seo: {
                    title: "",
                    description: "",
                    keywords: "",
                },
            }
        },
        methods: {
            getPage() {
                axios.get('/api/admin/page', {params: {slug:this.slug}})
                    .then((response) => {
                        this.page_id = response.data.id;
                        this.seo = response.data.seo;
                        console.log(response.data);
                    })
            },
            submitSeo() {
                axios.post('/api/admin/page/' + this.page_id + '/update', this.seo)
                    .then((response) => {
                        console.log(response.data);
                    })
            },
        },
        mounted() {
            this.getPage();
        }
    }
</script>
