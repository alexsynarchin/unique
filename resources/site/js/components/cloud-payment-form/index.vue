<template>

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
                order_id: null,

            }
        },
        methods: {
            getOrder(order_id) {
                axios.get('/api/unique-order/show/' + order_id)
                    .then((response) => {
                        if(response.data) {
                            bus.$emit('make-cloudpayments', response.data);
                        }
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },
        },
        created() {


        },
        mounted() {
            let urlParams = new URLSearchParams(window.location.search);


            if(urlParams.has('order_id')) {
                this.getOrder(urlParams.get('order_id'))
            }

        }
    }
</script>
