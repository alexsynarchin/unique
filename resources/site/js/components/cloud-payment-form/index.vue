<template>
    <div class="cloudPayments-payment-page ">
        <h1
            class="page-title text-center">
            Оплата проверки уникальности
        </h1>
    </div>
</template>
<script>
    import { bus } from '@/site/js/services/bus.js';
    export default {
        props: {
            order: {
                type:Object
            }
        },
        data() {
            return {

            }
        },
        created() {

        },
        mounted() {
            bus.$emit('make-cloudpayments', this.order);
        }
    }
</script>
