<template>
    <!--<div class="modal fade unique-modal" id="pay_check"  tabindex="-1" role="dialog"  aria-hidden="true">-->
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
                    <text-block></text-block>
                    <repost></repost>
                    <div class="row">
                        <div class="u-form-group col-md-6">
                            <label class="u-form-group__label">
                                Имя
                            </label>
                            <div class="u-input-group"
                                 :class="{'is-invalid': errors.has('name')}">
                                <i class="u-input-group__icon">
                                    <svg viewBox="0 0 24 24" class="u-input-group__svg">
                                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-user"></use>
                                    </svg>
                                </i>
                                <input class="u-input-group__input"
                                       placeholder=""
                                       v-model="form.name"
                                       :class="{'is-invalid':  errors.has('name')}">

                            </div>
                            <div class="invalid-feedback" v-text="errors.get('name')"></div>
                        </div>

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
                    </div>
                    <div class="row">
                        <div class="u-form-group col-md-6">
                            <label class="u-form-group__label">
                                Необходимые сроки
                            </label>
                            <div class="u-input-group"
                                 :class="{'is-invalid': errors.has('date')}">
                                <i class="u-input-group__icon">
                                    <svg viewBox="0 0 24 24" class="u-input-group__svg">
                                        <use xlink:href="assets/site/images/sprites.svg?ver=42#sprite-calendar"></use>
                                    </svg>
                                </i>
                                <input class="u-input-group__input"
                                       type="date"
                                       placeholder=""
                                       v-model="form.date"
                                       :class="{'is-invalid': errors.has('date')}">

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
                        <div class="u-input-group "  :class="{'is-invalid': errors.has('name')}">
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
                    <button class="btn button pay-check-modal__btn" @click.prevent="uniqueCheck">Проверить уникальность</button>
                    <div class="pay-check-modal__footer-text">
                        Нажимая кнопку «Проверить уникальность» вы соглашаетесь на обработку персональных данных
                    </div>
                </div>

            </div>
        </div>
    <!--</div>-->
</template>
<script>
    import { Errors } from  '@/common/js/services/errors.js';
    import TextBlock from "./components/TextBlock";
    export default {
        components: {
            TextBlock,
        },
        data() {
            return {
                form: {
                    name:"",
                    date:"",
                    email: "",
                    comment:"",
                    promocode:""
                },
                textParams: {},
                errors: new Errors(),
            }
        },
        methods: {
            showModal(data, list) {
                this.textParams = data;
                this.systems = list;
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
                this.textParams.promocode = this.form.promocode;
                axios.post('/api/check-unique-make-report', this.textParams)
                    .then((response) => {
                        this.$root.isLoading = false;
                        window.location.href = response.data;
                    })
                    .catch((error) => {
                        this.$root.isLoading = false;
                        this.errors.record(error.response.data.errors);
                    })
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



