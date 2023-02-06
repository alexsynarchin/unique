<template>
    <div class="modal fade unique-modal" id="rewrite_modal"  tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered unique-modal__dialog" role="document">
            <div class="unique-modal__content modal-content">
                <button  class="unique-modal__close" type="button"  data-bs-dismiss="modal" aria-label="Close">
                    <svg viewBox="0 0 41 40">
                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-close-gray"></use>
                    </svg>
                </button>
                <form class="pay-check-modal__form">
                    <h3 class="unique-modal__title">
                        Рерайт текста
                    </h3>
                    <p class="pay-check-modal__descr">
                        Оставьте заявку на расчет стоимости рерайта текста
                    </p>
                    <text-block
                        @inputFile="inputFile"
                        @inputText="inputText"></text-block>
                    <repost></repost>
                    <div class="row">
                        <div class="u-form-group col-md-6">
                            <label class="u-form-group__label">
                                Имя
                            </label>
                            <div class="u-input-group"
                                 :class="{'is-invalid': errors.has('name')|| errors.has('plain_text')  || errors.has('symbolsCount')}">
                                <i class="u-input-group__icon">
                                    <svg viewBox="0 0 24 24" class="u-input-group__svg">
                                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-user"></use>
                                    </svg>
                                </i>
                                <input class="u-input-group__input"
                                       placeholder=""
                                       v-model="form.name"
                                       :class="{'is-invalid':  errors.has('name') || errors.has('plain_text')  || errors.has('symbolsCount')}">

                            </div>
                            <div class="invalid-feedback" v-text="errors.get('name')"></div>
                            <div class="invalid-feedback" v-if="errors.has('plain_text')" v-text="errors.get('plain_text')"></div>
                            <div class="invalid-feedback" v-if="errors.has('symbolsCount')" v-text="errors.get('symbolsCount')"></div>
                        </div>
                        <div class="u-form-group col-md-6">
                            <label class="u-form-group__label">
                                Телефон
                            </label>
                            <div class="u-input-group"   :class="{'is-invalid': errors.has('phone')}">
                                <i class="u-input-group__icon">
                                    <svg viewBox="0 0 24 24" class="u-input-group__svg u-input-group__svg--phone">
                                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-phone"></use>
                                    </svg>
                                </i>
                                <input class="u-input-group__input"
                                       v-model="form.phone"
                                       :class="{'is-invalid': errors.has('phone')}"
                                       v-phone
                                >
                            </div>
                            <div class="invalid-feedback consultation-form__invalid-feedback" v-text="errors.get('phone')"></div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="u-form-group col-md-6">
                            <label class="u-form-group__label">
                                Укажите E-mail для получения отчета
                            </label>
                            <div class="u-input-group"
                                 :class="{'is-invalid': errors.has('email') }">
                                <i class="u-input-group__icon">
                                    <svg viewBox="0 0 24 24" class="u-input-group__svg">
                                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-mail-white"></use>
                                    </svg>
                                </i>
                                <input class="u-input-group__input"
                                       placeholder="Ваш e-mail"
                                       v-model="form.email"
                                       :class="{'is-invalid': errors.has('email') }">
                            </div>
                            <div class="invalid-feedback" v-if="errors.has('email')" v-text="errors.get('email')"></div>

                        </div>
                        <div class="u-form-group col-md-6">
                            <label class="u-form-group__label">
                                Необходимые сроки
                            </label>
                            <div class="u-input-group "  :class="{'is-invalid': errors.has('date')}">
                                <i class="u-input-group__icon">
                                    <svg viewBox="0 0 24 24" class="u-input-group__svg ">
                                        <use xlink:href="assets/site/images/sprites.svg?ver=41#sprite-calendar"></use>
                                    </svg>
                                </i>
                                <datepicker

                                    v-model="form.date"
                                    format="dd.MM.yyyy"
                                    wrapper-class="u-datepicker__wrap"
                                    :use-utc="true"
                                    :disabledDates="disabledDates"
                                    input-class="u-input-group__input u-datepicker"
                                    :language="ru">
                                </datepicker>
                            </div>
                            <div class="invalid-feedback" v-if="errors.has('date')" v-text="errors.get('date')"></div>
                        </div>

                        <div class="u-form-group col-md-6">
                            <label class="u-form-group__label">
                                Укажите промокод
                            </label>
                            <div class="u-input-group"
                                 :class="{'is-invalid': errors.has('promocode')}">
                                <i class="u-input-group__icon">
                                    <svg viewBox="0 0 24 24" class="u-input-group__svg">
                                        <use xlink:href="assets/site/images/sprites.svg?ver=42#sprite-percent"></use>
                                    </svg>
                                </i>
                                <input class="u-input-group__input"
                                       placeholder="Ваш промокод"
                                       v-model="form.promocode"
                                       :class="{'is-invalid': errors.has('promocode')}">

                            </div>
                            <div class="invalid-feedback" v-if="errors.has('promocode')" v-text="errors.get('promocode')"></div>
                        </div>
                    </div>
                    <div class="u-form-group">
                        <label class="u-form-group__label">
                            Комментарий
                        </label>
                        <div class="u-input-group "  :class="{'is-invalid': errors.has('comment')}">
                            <i class="u-input-group__icon u-input-group__icon--textarea">
                                <svg viewBox="0 0 24 24" class="u-input-group__svg ">
                                    <use xlink:href="assets/site/images/sprites.svg?ver=41#sprite-comment"></use>
                                </svg>
                            </i>
                            <textarea class="u-input-group__input u-input-group__input--textarea"
                                      v-model="form.comment"
                                      :class="{'is-invalid': errors.has('comment')}"
                            ></textarea>
                        </div>
                        <div class="invalid-feedback" v-text="errors.get('comment')"></div>
                    </div>

                </form>
                <div class="pay-check-modal__footer">
                    <button class="btn button pay-check-modal__btn" @click.prevent="submitForm">Рассчитать стоимость</button>
                    <div class="pay-check-modal__footer-text">
                        Нажимая кнопку «Рассчитать стоимость» вы соглашаетесь на обработку персональных данных
                    </div>
                </div>

            </div>
        </div>
  </div>
</template>
<script>
    import Datepicker from 'vuejs-datepicker';
    import dayjs from "dayjs";
    require('dayjs/locale/ru');
    import {en, ru} from 'vuejs-datepicker/dist/locale'
    import { Errors } from  '@/common/js/services/errors.js';
    import TextBlock from "./components/TextBlock";
    export default {
        components: {
            TextBlock, Datepicker
        },
        data() {
            return {
                en: en,
                ru: ru,
                disabledDates: {
                    to:new Date(), //dayjs().format('DD.MM.YYYY')
                },
                form: {
                    file:null,
                    name:"",
                    date:"",
                    phone: "",
                    email: "",
                    comment:"",
                    promocode:"",
                    plain_text: "",
                    text_params: {},
                },
                errors: new Errors(),
            }
        },
        methods: {
            showModal() {
                console.log('test');
                $('#rewrite_modal').modal('show');
            },
            customFormatter(date) {

                return  dayjs(date).format('DD/MM/YYYY')
            },
            submitForm() {
                this.$root.isLoading = true;
                if(this.form.date) {
                    this.form.date = dayjs(this.form.date).format('DD.MM.YYYY')
                }
                const formData = new FormData();
                for ( var key in this.form ) {
                    formData.append(key, this.form[key]);
                }
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                axios.post('/api/rewrite/order', formData, config)
                    .then((response) => {
                        this.$root.isLoading = false;
                        $('#rewrite_modal').modal('hide');
                        this.$toast("Ваша заявка отправлена. Наш менеджер свяжется с вами в близжайшее время.", {
                            timeout: 500,
                            type: 'success',
                            hideProgressBar: true,
                        });
                        console.log(response.data)
                    })
                    .catch((error) => {
                        this.$root.isLoading = false;
                        this.errors.record(error.response.data.errors);
                    })
            },
            inputText(data) {
                this.form.plain_text = data.plainText;
                delete data['plainText'];
                this.form.text_params = data;
            },
            inputFile(file) {
                this.form.file = file;
            }
        },
        mounted() {
            var rewriteModal = document.getElementById('rewrite_modal');
            let vm = this;
            rewriteModal.addEventListener('hidden.bs.modal', function (event) {
                vm.errors.clear();
            });

            setTimeout(() => {
                const params = new URLSearchParams(window.location.search);
                if(params.has('rewrite')) {
                    this.showModal()
                }

            }, 300)
        }
    }
</script>



