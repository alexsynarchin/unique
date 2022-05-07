<template>
    <li class="price-list-item price-list__item">
        <section class="price-list-item__left">
            <figure class="price-list-item__logo">
                <img :src="data.logo" v-if="data.logo">
                <svg viewBox="0 0 39 39" class="price-list-item__icon" v-else>
                    <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-magnifying-glass"></use>
                </svg>
            </figure>
            <div class="price-list-item__content">
                <h4 class="price-list-item__title" v-if="data.title">
                    {{data.title}}
                </h4>
                <p class="price-list-item__description" :class="{'price-list-item__description--big':data.class}">
                    {{data.description}}
                </p>
            </div>
        </section>
        <section class="price-list-item__right">
            <span class="price-list-item__price">
                {{data.price}}
            </span>
        </section>
    </li>
</template>
<script>
    export default {
        props: {
            data:{
                type:Object,
            },
        },
    }
</script>
