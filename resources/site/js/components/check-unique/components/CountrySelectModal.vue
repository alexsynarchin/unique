<template>
    <div class="modal unique-modal" id="payment_country_select"  tabindex="-1" role="dialog"  aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered unique-modal__dialog" role="document">
            <div class="unique-modal__content modal-content">
                <button  class="unique-modal__close" type="button"  data-bs-dismiss="modal" aria-label="Close">
                    <svg viewBox="0 0 41 40">
                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-close-gray"></use>
                    </svg>
                </button>
                <h3 class="unique-modal__title">
                    Выберите способ оплаты
                </h3>
                <div class="row">
                    <div class="col-md-6">
                        <section class="card" style="height: 100%">
                            <div class="card-body">
                                <h4 class="cart-title">
                                    <img style="width: 64px"  src="/assets/site/images/russia_icon.png"> Я из России
                                </h4>
                                <p>
                                    Отлично!<br>
                                    Только для баноковских карт, которые были выпущены на территории РФ
                                </p>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-3">
                                            <label>Ваш счет:</label>
                                            <span>{{paymentData.sum}} руб.</span>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn button" @click.prevent="makePayment(true)">Оплатить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-6">
                        <section class="card" style="height: 100%">
                            <div class="card-body">
                                <h4 class="cart-title">
                                    <img style="width: 64px"  src="/assets/site/images/earth-icon.png"> Я из другой страны
                                </h4>
                                <p>
                                    Уважаемые клиенты!<br>
                                    Из-за санкций, для клиентов из России мы вынуждены выставлять счет в тенге.
                                </p>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-3">
                                            <label>Ваш счет:</label>
                                            <span>{{paymentData.sum}} руб.</span>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn button " @click.prevent="makePayment(false)">Оплатить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { bus } from '@/site/js/services/bus.js';
export default {
    data() {
        return {
            paymentData: {
                sum:0,
                url:"",
                check_unique_id:null,
                russia:null,
            },

        }
    },
    methods: {
        showModal(data) {
            console.log(data);
            this.paymentData.sum = data.sum;
            this.paymentData.url = data.url;
            this.paymentData.check_unique_id = data.check_unique_id;
            $('#payment_country_select').modal('show');
        },
        makePayment(type) {
            console.log(type);
            this. paymentData.russia = type;
            axios.post('/api/unique-order/payment', this.paymentData)
                .then((response) => {
                    window.location.href = response.data;
                })
                .catch((error) => {

                })
        },
    },
    created() {
        bus.$on('select-payment-country', this.showModal)
    }

}
</script>
