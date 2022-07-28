<template>
    <section>
        <h1>Страница о компании</h1>
        <utp class="mb-5"></utp>
        <ratings class="mb-5"></ratings>
        <guarantees></guarantees>
    </section>
</template>
<script>
import utp from './components/utp'
import ratings from "./components/ratings/ratings";
import guarantees from "./components/guarantees/guarantees";
    export default {
        components: {
            utp, ratings, guarantees
        }
    }
</script>
