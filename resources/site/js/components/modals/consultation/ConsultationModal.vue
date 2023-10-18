<template>
   <div class="modal fade unique-modal" id="order-call"  tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered unique-modal__dialog" role="document">
            <div class="unique-modal__content consultation-modal__content modal-content">
                <button  class="unique-modal__close consultation-modal__close" type="button"  data-bs-dismiss="modal" aria-label="Close">
                    <svg viewBox="0 0 41 40" class="consultation-modal__close-icon--mobile">
                        <use xlink:href="/assets/site/images/sprites.svg?ver=44#sprite-close-gray"></use>
                    </svg>
                    <svg viewBox="0 0 41 40" class="consultation-modal__close-icon--desctop">
                        <use xlink:href="/assets/site/images/sprites.svg?ver=44#sprite-close-white"></use>
                    </svg>
                </button>
                <div class="consultation-modal__form">
                    <h3 class="unique-modal__title">
                        Бесплатная консультация
                    </h3>
                    <p class="unique-modal__descr">
                        Оставьте заявку для связи со специалистом
                    </p>
                    <form class="consultation-form">
                        <div class="u-form-group">
                            <label class="u-form-group__label">
                                Имя
                            </label>
                            <div class="u-input-group"  :class="{'is-invalid': errors.has('name')}">
                                <i class="u-input-group__icon">
                                    <svg viewBox="0 0 24 24" class="u-input-group__svg u-input-group__svg--user">
                                        <use xlink:href="/assets/site/images/sprites.svg?ver=44#sprite-user"></use>
                                    </svg>
                                </i>
                                <input class="u-input-group__input"
                                       v-model="form.name"
                                       :class="{'is-invalid': errors.has('name')}"
                                >
                            </div>
                            <div class="invalid-feedback consultation-form__invalid-feedback" v-text="errors.get('name')"></div>
                        </div>
                        <div class="u-form-group">
                            <label class="u-form-group__label">
                                Телефон
                            </label>
                            <div class="u-input-group"   :class="{'is-invalid': errors.has('phone')}">
                                <i class="u-input-group__icon">
                                    <svg viewBox="0 0 24 24" class="u-input-group__svg u-input-group__svg--phone">
                                        <use xlink:href="/assets/site/images/sprites.svg?ver=44#sprite-phone"></use>
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
                        <div class="u-form-group">
                            <label class="u-form-group__label">
                                Почта
                            </label>
                            <div class="u-input-group"   :class="{'is-invalid': errors.has('email')}">
                                <i class="u-input-group__icon">
                                    <svg viewBox="0 0 24 24" class="u-input-group__svg u-input-group__svg--phone">
                                        <use xlink:href="/assets/site/images/sprites.svg?ver=44#sprite-phone"></use>
                                    </svg>
                                </i>
                                <input class="u-input-group__input"
                                       v-model="form.email"
                                       :class="{'is-invalid': errors.has('email')}"
                                >
                            </div>
                            <div class="invalid-feedback consultation-form__invalid-feedback" v-text="errors.get('email')"></div>
                        </div>
                        <div class="u-form-group">
                            <label class="u-form-group__label">
                                Комментарий
                            </label>
                            <div class="u-input-group u-input-group--dark"  :class="{'is-invalid': errors.has('comment')}">
                                <i class="u-input-group__icon u-input-group__icon--textarea">
                                    <svg viewBox="0 0 24 24" class="u-input-group__svg ">
                                        <use xlink:href="/assets/site/images/sprites.svg?ver=41#sprite-comment"></use>
                                    </svg>
                                </i>
                                <textarea class="u-input-group__input u-input-group__input--textarea"
                                          v-model="form.comment"
                                          :class="{'is-invalid': errors.has('comment')}"
                                ></textarea>
                            </div>
                            <div class="invalid-feedback consultation-form__invalid-feedback" v-text="errors.get('comment')"></div>
                        </div>
                        <div class="u-form-group">

                            <div class="invalid-feedback consultation-form__invalid-feedback" v-text="errors.get('token')"></div>
                        </div>


                        <div class="consultation-modal__footer">
                            <button class="btn button consultation-form__btn" @click.prevent="sendMsg">
                                Получить консультацию
                            </button>
                            <p class="consultation-form__descr">
                                Нажимая кнопку «Получить консультацию» вы соглашаетесь на обработку персональных данных
                            </p>
                        </div>
                    </form>
                </div>
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
                    name: '',
                    phone:'',
                    email:'',
                    token: '',
                    eKey: "",
                },
                errors: new Errors(),

            }
        },

       methods: {

            sendMsg() {

                axios.post('/api/contact/consultation', this.form)
                    .then((response) => {
                        $('#order-call').modal('hide');
                    })
                    .catch((error) => {
                        this.errors.record(error.response.data.errors);
                    })
            },


       },
       mounted() {

       },
       created() {

       }
   }
</script>
