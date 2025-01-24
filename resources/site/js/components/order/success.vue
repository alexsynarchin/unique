<template>
    <section>
        <div class="alert alert-success mb-3" role="alert" v-if="this.url">
            Оплата прошла успешно, вы будете перенаправлены на страницу отчета.
        </div>
        <div class="alert alert-success mb-3" role="alert" v-else>
        Оплата прошла успешно, в ближайшее время с вами свяжется наш менеджер
        </div>
        <button class="btn button" @click.prevent="goToReport" v-if="this.url">
           Перейти к отчету
        </button>
        <button v-else @click.prevent="goToReport">
            На Главную
        </button>
    </section>
</template>
<script>
    export default {
        props: ['url','error'],
        methods: {
            goToReport() {
                if(this.url) {
                    window.location.href = this.url;
                } else {
                    window.location.href = '/';
                }

            },
        },
        mounted() {
            if(this.url) {
                setTimeout(function () { this.goToReport() }.bind(this), 3000)
            }

        }
    }
</script>
