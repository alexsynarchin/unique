<template>
    <div class="modal fade unique-modal" id="pay_check"  tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered unique-modal__dialog" role="document">
            <div class="unique-modal__content modal-content">
                <button  class="unique-modal__close" type="button"  data-bs-dismiss="modal" aria-label="Close">
                    <svg viewBox="0 0 41 40">
                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-close-gray"></use>
                    </svg>
                </button>
                <form class="pay-check-modal__form">
                    <div class="pay-check-modal__heading">
                        <div class="pay-check-modal__heading-content">
                            <h3 class="unique-modal__title">
                                Мы уже приступили к проверке уникальности
                            </h3>
                            <p class="pay-check-modal__descr">
                                При необходимости выберите дополнительные услугии.
                                Скачать готовый отчет вы сможете после проведения оплаты
                            </p>
                        </div>
                        <figure class="pay-check-modal__heading-icon">
                            <img src="/assets/site/images/document.png">
                        </figure>
                    </div>
                    <service-list
                        :selected-services="services"
                        @select-service="selectService"
                    ></service-list>
                    <repost></repost>
                    <div class="row">
                        <div class="u-form-group col-md-6">
                            <label class="u-form-group__label">
                                Укажите E-mail для получения отчета
                            </label>
                            <div class="u-input-group"
                                 :class="{'is-invalid': errors.has('email') || errors.has('plainText')  || errors.has('symbolsCount')}">
                                <i class="u-input-group__icon">
                                    <svg viewBox="0 0 24 24" class="u-input-group__svg">
                                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-mail-white"></use>
                                    </svg>
                                </i>
                                <input class="u-input-group__input"
                                       placeholder="Ваш e-mail"
                                       v-model="form.email"
                                       :class="{'is-invalid': errors.has('email') || errors.has('plainText')  || errors.has('symbolsCount')}">

                            </div>
                            <div class="invalid-feedback" v-if="errors.has('email')" v-text="errors.get('email')"></div>
                            <div class="invalid-feedback" v-if="errors.has('plainText')" v-text="errors.get('plainText')"></div>
                            <div class="invalid-feedback" v-if="errors.has('symbolsCount')" v-text="errors.get('symbolsCount')"></div>
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
                </form>
                <div class="pay-check-modal__sum">
                    Итого к оплате: {{sum}} руб
                </div>
                <ul class="pay-check-modal-list">
                    <li class="pay-check-modal-list__item">
                        <label class="pay-check-modal-list__label">
                            Проверка по системе:
                        </label>
                        <span class="pay-check-modal-list__value">
                            <template v-for="(system, index) in systems">
                                {{system.title}}
                                <template v-if="index !== (systems.length - 1)">,</template>
                            </template>
                        </span>
                    </li>
                </ul>
                <div class="pay-check-modal__footer">
                    <button class="btn button pay-check-modal__btn" @click.prevent="uniqueCheck">Проверить уникальность</button>
                    <div class="pay-check-modal__footer-text">
                        Нажимая кнопку «Проверить уникальность» вы соглашаетесь на обработку персональных данных
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
import { Errors } from  '@/common/js/services/errors.js';
import ServiceList from "./ServiceList";
    export default {
        components: {
            ServiceList,
        },
        data() {
            return {
                form: {
                    email: "",
                    promocode:""
                },
                file:null,
                sum: 0,
                systems:[],
                services:[],
                textParams: {},
                errors: new Errors(),
            }
        },
        methods: {
            showModal(data, list, file) {
                this.textParams = data;
                this.systems = list;
                this.file = file;
                if(this.textParams.email) {
                    this.form.email = this.textParams.email;
                }
                this.systems.forEach((system) => {
                    console.log(system)
                    this.sum = this.sum + system.price;
                })
                $('#pay_check').modal('show');
            },
            uniqueCheck() {
                $('#pay_check').modal('show');
                this.$root.isLoading = true;
                this.textParams.email = this.form.email;
                this.textParams.systems = this.systems;
                this.textParams.services = this.services;
                this.textParams.promocode = this.form.promocode;
                this.textParams.file = this.file;
                const formData = new FormData();
                for ( var key in this.textParams ) {
                    let data;
                    if(key === 'systems' || key === 'services') {
                        data = JSON.stringify(this.textParams[key])
                    } else {
                        data = this.textParams[key];
                    }

                    formData.append(key, data);
                }
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                axios.post('/api/check-unique-make-report', formData, config)
                    .then((response) => {
                        this.$root.isLoading = false;
                        window.location.href = response.data;
                    })
                    .catch((error) => {
                        this.$root.isLoading = false;
                        this.errors.record(error.response.data.errors);
                    })
            },
             selectService(data) {
                if(this.services.indexOf(data) === -1) {
                    this.services.push(data);
                } else {
                    let index = this.services.indexOf(data);
                    this.services.splice(index, 1);
                }

             }
        },
        mounted() {

            var payCheckModal = document.getElementById('pay_check');
            let vm = this;
            payCheckModal.addEventListener('hidden.bs.modal', function (event) {
                vm.errors.clear();
            });
        }
    }
</script>
