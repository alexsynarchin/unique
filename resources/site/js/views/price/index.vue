<template>
    <section class="price-page">
        <price-list
            :key="index"
            :data="item" v-for="(item, index) in prices"></price-list>
    </section>
</template>
<script>
    import PriceList from "../../components/price-list";
    export default {
        components: {
            PriceList,
        },
        data() {
            return {
                prices : []
            }
        },
        methods: {
            getList() {
                axios.get('/api/block-list/price')
                    .then((response) => {
                        this.prices = response.data;
                    })
            }
        },
        mounted() {
            this.getList();
        }
    }
</script>
