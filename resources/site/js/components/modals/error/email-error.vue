<template>
    <div  class="modal fade unique-modal" id="error_modal"  tabindex="-1" role="dialog"  aria-hidden="true" style="background: rgba(0,0,0,0.5); ">
        <div class="modal-dialog modal-dialog-centered unique-modal__dialog" role="document" style="z-index: 30000">
            <div class="unique-modal__content modal-content" style="background: #F0F1F6;">
                <button  class="unique-modal__close" type="button"  data-bs-dismiss="modal" aria-label="Close">
                    <svg viewBox="0 0 41 40">
                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-close-gray"></use>
                    </svg>
                </button>
                <h3 class="unique-modal__title">
                    Ваш промокод - repost-promo
                </h3>
                <button class="btn button u-form-group__btn" @click.prevent="closeModal">Закрыть</button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['error'],
        data() {
            return {

            }
        },
        methods: {
            showModal() {
                $('#promo_modal').modal('show');
            },
            closeModal() {
                $('#promo_modal').modal('hide');
            }
        }
    }
</script>
