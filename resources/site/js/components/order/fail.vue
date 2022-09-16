<template>
    <section>
        <div class="alert alert-danger mb-3" role="alert">
           Попытка оплаты не удалась, вы можете попробовать оплатить еще раз.
        </div>
        <div class="text-center">
            <button class="btn button" @click.prevent="goToPayment">
                Оплатить
            </button>
        </div>
    </section>
</template>
<script>
    export default {
        props:['url'],
        data() {
            return {

            }
        },
        methods: {
            goToPayment() {
                window.location.href=this.url;
            }
        }
    }
</script>
