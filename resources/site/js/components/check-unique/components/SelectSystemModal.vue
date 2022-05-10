<template>
    <section class="">
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
                                    <div class="u-input-group"  :class="{'is-invalid': errors.has('email')}">
                                        <i class="u-input-group__icon">
                                            <svg viewBox="0 0 24 24" class="u-input-group__svg">
                                                <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-mail-white"></use>
                                            </svg>
                                        </i>
                                        <input class="u-input-group__input"
                                               placeholder="Ваш e-mail"
                                               v-model="form.email"
                                               :class="{'is-invalid': errors.has('email')}"
                                        >
                                    </div>
                                    <div class="invalid-feedback" v-text="errors.get('email')"></div>
                                </div>
                                <button class="btn button u-form-group__btn">Проверить текст</button>
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

        <div class="modal fade unique-modal" id="select_system"  tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered unique-modal__dialog" role="document">
                <div class="unique-modal__content modal-content">
                    <button  class="unique-modal__close" type="button"  data-bs-dismiss="modal" aria-label="Close">
                        <svg viewBox="0 0 41 40">
                            <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-close-gray"></use>
                        </svg>
                    </button>
                    <h3 class="unique-modal__title">
                        Бесплатная проверка уникальности текста
                    </h3>
                    <div class="select-system-modal-content">
                        <figure class="select-system-modal-content__img">
                            <img src="/assets/site/images/mp/system-logo-1.png">
                        </figure>
                        <div class="select-system-modal-content__right">
                            <div class="select-system-modal-content__text">
                                Очень часто студенты проверяют свои курсовые, дипломные работы или рефераты в бесплатной версии (общедоступной) Антиплагиат, получив высокий процент уникальности при проверке - отправляют преподавателю такую работу. Часто студенты проверяют свои курсовые, дипломные работы
                            </div>
                            <button class="btn button" @click="selectSystem(index)">
                                Выбрать NASH Antiplagiat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>
<script>
import { Errors } from  '@/common/js/services/errors.js';
    export default {
        data() {
            return {
                index:null,
                form: {
                    email: "",
                },
                errors: new Errors(),
            }
        },
        methods: {
            showSelectSystem(index) {
                this.index = index;
                $('#select_system').modal('show');
            },
            selectSystem(index) {
                this.$emit('selectSystem', index);
                $('#select_system').modal('hide');
            }
        },
    }
</script>
