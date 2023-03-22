<template>
    <section>
        <h1>Страница отзывов</h1>
        <el-tabs type="card" v-model="activeTab">
            <el-tab-pane label="Основная информация" name="main">
        <reviews-list></reviews-list>
            </el-tab-pane>
            <el-tab-pane label="Настройки и SEO" name="config">
                <Seo :form = "seo" v-if="seo"></Seo>
                <el-button type="success" @click.prevent="submitSeo">Сохранить</el-button>
            </el-tab-pane>
        </el-tabs>
    </section>
</template>
<script>
import ReviewsList from "./reviews-list/ReviewsList";
import Seo from '@/admin/js/components/seo/seo.vue'
    export default {
        components: {ReviewsList, Seo},
        data() {
            return {
                activeTab: 'main',
                seo: {
                    title: "",
                    description: "",
                    keywords: "",
                },
            }
        }
    }
</script>
