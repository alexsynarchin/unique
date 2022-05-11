<template>
    <div class="modal fade unique-modal" id="free_check"  tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered unique-modal__dialog" role="document">
            <div class="free-check-modal__content unique-modal__content modal-content">
                <button  class="unique-modal__close" type="button"  data-bs-dismiss="modal" aria-label="Close">
                    <svg viewBox="0 0 41 40">
                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-close-gray"></use>
                    </svg>
                </button>
                <form class="free-check-modal__form">
                    <h3 class="unique-modal__title">
                        Бесплатная проверка уникальности текста
                    </h3>
                    <div class="u-form-group">
                        <label class="u-form-group__label">
                            Укажите E-mail для получения отчета
                        </label>
                        <div class="u-form-group__btn-wrap">
                            <div class="u-input-group__btn-wrap">
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
                            <button class="btn button u-form-group__btn" @click.prevent="uniqueCheck">Проверить текст</button>
                        </div>
                    </div>
                </form>
                <ul class="free-check-modal-list">
                    <li class="free-check-modal-list__item">
                        <img src="/assets/site/images/modals/free-check-1.png">
                    </li>
                    <li class="free-check-modal-list__item">
                        <img src="/assets/site/images/modals/free-check-2.png">
                    </li>
                    <li class="free-check-modal-list__item">
                        <img src="/assets/site/images/modals/free-check-3.png">
                    </li>
                    <li class="free-check-modal-list__item">
                        <img src="/assets/site/images/modals/free-check-4.png">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
import { Errors } from  '@/common/js/services/errors.js';
    export default {
        data() {
            return {
                form: {
                    email: "",
                },
                textParams: {},
                errors: new Errors(),
            }
        },
        methods: {
            showModal(data) {
                this.textParams = data;
                $('#free_check').modal('show');
            },
            uniqueCheck() {
                $('#free_check').modal('show');
                this.$root.isLoading = true;
                this.textParams.email = this.form.email;
                axios.post('/api/check-unique-make-report', this.textParams)
                    .then((response) => {
                        window.location.href = response.data;
                    })
                    .catch((error) => {
                        this.$root.isLoading = false;
                        this.errors.record(error.response.data.errors);
                    })
            }
        },
        mounted() {
            var freeCheckModal = document.getElementById('free_check');
            let vm = this;
            freeCheckModal.addEventListener('hidden.bs.modal', function (event) {
                vm.errors.clear();
            });
        }
    }
</script>
