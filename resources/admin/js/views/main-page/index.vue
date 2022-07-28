<template>
    <section>
        <h1>
            Настройки главной
        </h1>
        <utp class="mb-5"></utp>
        <ratings class="mb-5"></ratings>
        <why class="mb-5"></why>
        <process class="mb-5"></process>
        <about class="mb-5"></about>
        <reviews class="mb-5"></reviews>
    </section>
</template>
<script>
    import utp from "./components/utp";
    import ratings from "./components/ratings/ratings";
    import why from "./components/why/why";
    import process from "./components/process/process";
    import about from "./components/about/about";
    import reviews from "./components/reviews/reviews";
export default {
    components: {
        utp, ratings, why, process, about, reviews
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
