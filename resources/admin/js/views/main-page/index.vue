<template>
    <section>
        <h1>
            Настройки главной
        </h1>
        <utp class="mb-5"></utp>
        <ratings class="mb-5"></ratings>
        <why class="mb-5"></why>
    </section>
</template>
<script>
    import utp from "./components/utp";
    import ratings from "./components/ratings/ratings";
    import why from "./components/why/why";
export default {
    components: {
        utp, ratings, why
    },
    data() {
     return {
        form: {

        },
     }
 },
    methods: {

    }
}
</script>
