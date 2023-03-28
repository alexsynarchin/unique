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
                slug: "reviews",
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
