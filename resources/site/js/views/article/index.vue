<template>
    <section>
        <div class="article-list">
            <div class="article-list__item" v-for="(item, index) in articles">
                <article-item
                    :article="item"
                >
                </article-item>
            </div>
        </div>
    </section>
</template>
<script>
    import ArticleItem from "./ArticleItem";
    export default {
        components: {
            ArticleItem,
        },
        data() {
            return {
                articles:[],
            }
        },
        methods: {
            getArticles() {
                axios.get('/api/articles')
                    .then((response) => {
                        this.articles = response.data;
                    })
            },
        },
        mounted() {
            this.getArticles();
        }
    }
</script>
