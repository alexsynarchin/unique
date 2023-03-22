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
                seo: {
                    title: "",
                    description: "",
                    keywords: "",
                },
            }
        },
        methods: {
            submitSeo() {

            },
        },
        mounted() {

        }
    }
</script>
