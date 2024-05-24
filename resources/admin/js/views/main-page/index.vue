<template>
    <section>
        <h1>
            Настройки главной
        </h1>
        <el-tabs type="card" v-model="activeTab">
            <el-tab-pane label="Основная информация" name="main">
                <H1Title class="mb-4"></H1Title>
                <utp class="mb-5"></utp>
                <ratings class="mb-5"></ratings>
                <why class="mb-5"></why>
                <process class="mb-5"></process>
                <about class="mb-5"></about>
                <reviews class="mb-5"></reviews>
                <faq class="mb-5"></faq>
            </el-tab-pane>
            <el-tab-pane label="Настройки и SEO" name="config">
                <Seo :form = "seo" v-if="seo"></Seo>
                <el-button type="success" @click.prevent="submitSeo">Сохранить</el-button>
            </el-tab-pane>
        </el-tabs>


    </section>
</template>
<script>
    import utp from "./components/utp";
    import ratings from "./components/ratings/ratings";
    import why from "./components/why/why";
    import process from "./components/process/process";
    import about from "./components/about/about";
    import reviews from "./components/reviews/reviews";
    import faq from "./components/faq/faq";
    import Seo from '@/admin/js/components/seo/seo.vue';
    import H1Title from "@/admin/js/views/main-page/components/h1-title.vue";
export default {
    components: {
        utp, ratings, why, process, about, reviews, faq, Seo, H1Title
    },
    data() {
     return {
         activeTab: 'main',
         slug: "home",
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
