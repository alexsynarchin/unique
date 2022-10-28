<template>
    <section v-if="can(CanAccess) || is('Super-Admin')">
        <h1>Страница отзывов</h1>
        <reviews-list></reviews-list>
    </section>
</template>
<script>
import ReviewsList from "./reviews-list/ReviewsList";
    export default {
        components: {ReviewsList},
        data() {
            return {
                CanAccess: 'Просмотр "Отзывы"'
            }
        }
    }
</script>
