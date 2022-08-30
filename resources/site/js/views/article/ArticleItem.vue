<template>
    <a href="" class="article-item">
        <section class="article-item__content">
            <figure class="article-item__preview">
                <img :src="article.preview">
            </figure>
            <h3 class="article-item__title">
                {{article.title}}
            </h3>
            <div class="article-item__description" v-html="article.description"></div>

        </section>
        <div class="article-item__footer">
            <span class="article-item__date">
                {{article.date}}
            </span>
            <span class="article-item__views">
                {{article.views}}
            </span>
        </div>
    </a>
</template>
<script>
    export default {
        props: {
            article: {
                type:Object,
            }
        },
    }
</script>
