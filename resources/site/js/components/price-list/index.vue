<template>
    <section class="price-block">
            <h3 class="price-block__title">
                {{data.title}}
            </h3>
            <div class="price-block__heading">
                <label class="price-block__label">
                    {{data.options.label}}
                </label>
                <label class="price-block__label">
                    Стоимость:
                </label>
            </div>
            <ul class="price-list">
                <item
                    :key="index"
                    :data="item"
                    v-for="(item, index) in data.list"></item>
            </ul>
        <div class="price-block__description" v-if="data.description">
            {{data.description}}
        </div>
            <a href="" v-if="data.options.button" class="btn button">Проверить уникальность текста</a>
    </section>
</template>
<script>
import item from "./components/item"
    export default {
    components: {
        item,
    },
        props: {
            data: {
                type:Object,
            }
        }
    }
</script>
