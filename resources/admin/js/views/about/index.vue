<template>
    <section v-if="can(CanAccess) || is('Super-Admin')">
        <h1>Страница о компании</h1>
        <utp class="mb-5"></utp>
        <ratings class="mb-5"></ratings>
        <guarantees class="mb-5"></guarantees>
        <work-result></work-result>
    </section>
</template>
<script>
import utp from './components/utp'
import ratings from "./components/ratings/ratings";
import guarantees from "./components/guarantees/guarantees";
import WorkResult from "./components/work-result/WorkResult";
    export default {
        components: {
            utp, ratings, guarantees, WorkResult
        },
        data() {
            return {
                CanAccess: 'Просмотр "О проекте"',
            }
        },
        mounted() {
            if(can('Просмотр "О проекте"') && !is('Super-Admin')) {
                window.location.href='/admin'
            }
        }
    }
</script>
