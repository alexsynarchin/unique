<template>
    <section>
        <h1>Страница о компании</h1>
        <utp class="mb-5"></utp>
        <ratings class="mb-5"></ratings>
    </section>
</template>
<script>
import utp from './components/utp'
import ratings from "./components/ratings/ratings";
    export default {
        components: {
            utp, ratings
        }
    }
</script>
