<template>
    <section>
        <h1>
            Настройки главной
        </h1>
        <utp class="mb-5"></utp>
        <ratings class="mb-5"></ratings>
        <why class="mb-5"></why>
        <process class="mb-5"></process>

    </section>
</template>
<script>
    import utp from "./components/utp";
    import ratings from "./components/ratings/ratings";
    import why from "./components/why/why";
    import process from "./components/process/process";
export default {
    components: {
        utp, ratings, why, process
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
