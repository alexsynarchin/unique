<template>
    <section>
        <form class="consultation-form payment-form mb-4">
            <div class="u-form-group">
                <label class="u-form-group__label">
                    E-mail
                </label>
                <div class="u-input-group"   :class="{'is-invalid': errors.has('email')}">
                    <i class="u-input-group__icon">
                        <svg viewBox="0 0 24 24" class="u-input-group__svg u-input-group__svg--phone">
                            <use xlink:href="/assets/site/images/sprites.svg?ver=44#sprite-mail-white"></use>
                        </svg>
                    </i>
                    <input class="u-input-group__input"
                           v-model="form.email"
                           :class="{'is-invalid': errors.has('email')}"
                    >
                </div>

                <div class="invalid-feedback consultation-form__invalid-feedback" v-text="errors.get('email')"></div>
                <p class="mt-2">Укажите ваш Email. Например ivanov@mail.ru</p>
            </div>

            <div class="u-form-group">
                <label class="u-form-group__label">
                    Услуга
                </label>
                <div class="u-input-group"  :class="{'is-invalid': errors.has('service')}">
                    <i class="u-input-group__icon">
                        <svg viewBox="0 0 24 24" class="u-input-group__svg u-input-group__svg--user">
                            <use xlink:href="/assets/site/images/sprites.svg?ver=44#sprite-user"></use>
                        </svg>
                    </i>
                    <input class="u-input-group__input"
                           v-model="form.service"
                           :class="{'is-invalid': errors.has('service')}"
                    >
                </div>
                <div class="invalid-feedback consultation-form__invalid-feedback" v-text="errors.get('service')"></div>
                <p class="mt-2">Укажите, за какую услугу оплачиваете, например - Проверка уникальности</p>
            </div>

            <div class="u-form-group">
                <label class="u-form-group__label">
                    Сумма оплаты
                </label>
                <div class="u-input-group"  :class="{'is-invalid': errors.has('sum')}">
                    <i class="u-input-group__icon">
                        <svg viewBox="0 0 24 24" class="u-input-group__svg u-input-group__svg--user">
                            <use xlink:href="/assets/site/images/sprites.svg?ver=49#sprite-payment"></use>
                        </svg>
                    </i>
                    <input class="u-input-group__input"
                           type="number"
                           min="1"
                           v-model="form.sum"
                           :class="{'is-invalid': errors.has('sum')}"
                    >
                </div>
                <div class="invalid-feedback consultation-form__invalid-feedback" v-text="errors.get('sum')"></div>
                <p class="mt-2"> Введите сумму оплаты. Например - 500. <br>
                    При оплате с зарубежных карт, сумма будет выставлена в валюте тенге, по текущему курсу
                </p>
            </div>


            <div class="consultation-modal__footer">
                <button class="btn button consultation-form__btn" @click.prevent="showSelectCountryModal">
                    Оплатить
                </button>

            </div>
        </form>
        <country-select-modal v-if="isCountryModal"></country-select-modal>
    </section>

</template>
<script>
import { Errors } from  '@/common/js/services/errors.js';
import CountrySelectModal from './CountrySelectModal.vue';

export default {
    components: {
        CountrySelectModal,
    },
    data() {
        return {
            isCountryModal:false,
            paymentData: {},
            form: {
                service: "",
                email: "",
                sum: 100,
            },
            errors: new Errors(),
        }
    },
    methods: {
        showSelectCountryModal() {
            axios.post('/api/validate-payment-form', this.form)
                .then((response) => {
                    this.paymentData = response.data;
                })
                .catch((error)=> {
                    this.errors.record(error.response.data.errors);
                })
            //this.isCountryModal = true;
        }
    }
}
</script>
