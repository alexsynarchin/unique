<template>
    <div class="modal fade unique-modal" id="order-call"  tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered unique-modal__dialog" role="document">
            <div class="unique-modal__content consultation-modal__content modal-content">
                <button  class="unique-modal__close consultation-modal__close" type="button"  data-bs-dismiss="modal" aria-label="Close">
                    <svg viewBox="0 0 41 40">
                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-close-white"></use>
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
                            <div class="u-input-group">
                                <i class="u-input-group__icon">
                                    <svg viewBox="0 0 24 24" class="u-input-group__svg u-input-group__svg--user">
                                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-user"></use>
                                    </svg>
                                </i>
                                <input class="u-input-group__input" >
                            </div>
                        </div>
                        <div class="u-form-group">
                            <label class="u-form-group__label">
                                Телефон
                            </label>
                            <div class="u-input-group">
                                <i class="u-input-group__icon">
                                    <svg viewBox="0 0 24 24" class="u-input-group__svg u-input-group__svg--phone">
                                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-phone"></use>
                                    </svg>
                                </i>
                                <input class="u-input-group__input" >
                            </div>
                        </div>
                        <div class="consultation-modal__footer">
                            <button class="btn button consultation-form__btn">
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
   export default {
        data() {
            return {

            }
        },
       methods: {

       },
       mounted() {

       }
   }
</script>
