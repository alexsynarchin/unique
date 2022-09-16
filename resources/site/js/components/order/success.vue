<template>
    <section>
        <div class="alert alert-success mb-3" role="alert">
            Оплата прошла успешно, вы будете перенаправлены на страницу отчета.
        </div>
        <button class="btn button" @click.prevent="goToReport">
           Перейти к отчету
        </button>
    </section>
</template>
<script>
    export default {
        props: ['url'],
        methods: {
            goToReport() {
                window.location.href = this.url;
            },
        },
        mounted() {
            setTimeout(function () { this.goToReport() }.bind(this), 3000)
        }
    }
</script>
