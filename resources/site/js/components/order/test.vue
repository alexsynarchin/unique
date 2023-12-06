<template>
    <section class="">
        <h2>Пробная оплата</h2>
        <button @click="testOrder">Провести оплату</button>
    </section>
</template>
<script>
    export default {
        data() {

        },
        methods: {
            testOrder() {
                axios.post('/api/check-robokassa-payment')
                    .then((response) => {
                        console.log(response.data)
                    })
            }
        }
    }
</script>
