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
                this.$root.isLoading = true;
                axios.get('/api/articles')
                    .then((response) => {
                        this.articles = response.data;
                        this.$root.isLoading = false;
                    })
            },
        },
        mounted() {
            this.getArticles();
        }
    }
</script>
