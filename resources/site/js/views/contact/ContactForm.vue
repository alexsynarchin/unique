<template>
    <form class="contact-form">
        <h3 class="contact-form__title">
            Ответим на все ваши вопросы!
        </h3>
        <div class="contact-form__row">
            <section class="contact-form__group">
                <div class="u-form-group">
                    <label class="u-form-group__label">
                        Имя
                    </label>
                    <div class="u-input-group u-input-group--dark"  :class="{'is-invalid': errors.has('name')}">
                        <i class="u-input-group__icon">
                            <svg viewBox="0 0 24 24" class="u-input-group__svg u-input-group__svg--user">
                                <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-user"></use>
                            </svg>
                        </i>
                        <input class="u-input-group__input"
                               v-model="form.name"
                               :class="{'is-invalid': errors.has('name')}"
                        >
                    </div>
                    <div class="invalid-feedback" v-text="errors.get('name')"></div>
                </div>
            </section>
            <section class="contact-form__group">
                <div class="u-form-group ">
                    <label class="u-form-group__label">
                        Телефон
                    </label>
                    <div class="u-input-group u-input-group--dark"   :class="{'is-invalid': errors.has('phone')}">
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
                    <div class="invalid-feedback" v-text="errors.get('phone')"></div>
                </div>
            </section>
        </div>
        <div class="u-form-group">
            <label class="u-form-group__label">
                Комментарий
            </label>
            <div class="u-input-group u-input-group--dark"  :class="{'is-invalid': errors.has('comment')}">
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
        <div class="contact-form__footer">
            <button class="btn button contact-form__btn" @click.prevent="sendMsg">
                Получить консультацию
            </button>
            <p class="contact-form__descr">
                Нажимая кнопку «Получить консультацию» вы соглашаетесь на обработку персональных данных
            </p>
        </div>
    </form>
</template>
<script>
import { Errors } from  '@/common/js/services/errors.js';
    export default {
        data() {
            return {
                form: {
                    name: '',
                    phone:'',
                    comment: ''
                },
                errors: new Errors(),
            }
        },
        methods: {
            sendMsg() {
                axios.post('/api/contact/consultation', this.form)
                    .then((response) => {

                    })
                    .catch((error) => {
                        this.errors.record(error.response.data.errors);
                    })
            },
        },
    }
</script>
